<?php
// portfolio.php - This file now dynamically adjusts navigation based on login status.
session_start(); // Start the session to access session variables

// You might want to include a logout script if you haven't already
// For example, if a 'logout.php' link is clicked:
// if (isset($_GET['action']) && $_GET['action'] == 'logout') {
//     session_destroy();
//     header("Location: login.php");
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PortfolioCraft | Build Your Freelance Portfolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .portfolio-item:hover .portfolio-overlay {
            opacity: 1;
            transform: translateY(0);
        }
        .portfolio-overlay {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s ease;
        }
        .animated-input:focus + label, .animated-input:not(:placeholder-shown) + label {
            transform: translateY(-24px) scale(0.8);
            color: #667eea;
        }
        #previewModal {
            transition: all 0.3s ease;
        }
        .modal-hidden {
            opacity: 0;
            visibility: hidden;
            transform: scale(0.8);
        }
        .modal-visible {
            opacity: 1;
            visibility: visible;
            transform: scale(1);
        }
    </style>
</head>
<body class="font-sans bg-gray-50">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <i class="fas fa-palette text-indigo-600 text-2xl mr-2"></i>
                        <span class="text-xl font-bold text-gray-900">PortfolioCraft</span>
                    </div>
                </div>
                <div class="hidden md:ml-6 md:flex md:items-center md:space-x-8">
                    <a href="#features" class="text-gray-900 hover:text-indigo-600 px-3 py-2 text-sm font-medium">Features</a>
                    <a href="#templates" class="text-gray-900 hover:text-indigo-600 px-3 py-2 text-sm font-medium">Templates</a>
                    <a href="#testimonials" class="text-gray-900 hover:text-indigo-600 px-3 py-2 text-sm font-medium">Testimonials</a>
                    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                        <a href="portfolio.php" class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-700 transition duration-300">Dashboard</a>
                        <a href="logout.php" class="border border-indigo-600 text-indigo-600 px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-50 transition duration-300">Log Out</a>
                    <?php else: ?>
                        <a href="signup.php" class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-700 transition duration-300">Sign Up</a>
                        <a href="login.php" class="border border-indigo-600 text-indigo-600 px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-50 transition duration-300">Log In</a>
                    <?php endif; ?>
                </div>
                <div class="-mr-2 flex items-center md:hidden">
                    <button type="button" id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none">
                        <span class="sr-only">Open main menu</span>
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <div class="hidden md:hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="#features" class="text-gray-900 hover:text-indigo-600 block px-3 py-2 text-base font-medium">Features</a>
                <a href="#templates" class="text-gray-900 hover:text-indigo-600 block px-3 py-2 text-base font-medium">Templates</a>
                <a href="#testimonials" class="text-gray-900 hover:text-indigo-600 block px-3 py-2 text-base font-medium">Testimonials</a>  
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                    <a href="portfolio.php" class="bg-indigo-600 text-white w-full px-4 py-2 rounded-md text-base font-medium hover:bg-indigo-700 transition duration-300 mt-2">Dashboard</a>
                    <a href="logout.php" class="border border-indigo-600 text-indigo-600 w-full px-4 py-2 rounded-md text-base font-medium hover:bg-indigo-50 transition duration-300 mt-2">Log Out</a>
                <?php else: ?>
                    <a href="signup.php" class="bg-indigo-600 text-white w-full px-4 py-2 rounded-md text-base font-medium hover:bg-indigo-700 transition duration-300 mt-2">Sign Up</a>
                    <a href="login.php" class="border border-indigo-600 text-indigo-600 w-full px-4 py-2 rounded-md text-base font-medium hover:bg-indigo-50 transition duration-300 mt-2">Log In</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <section class="gradient-bg text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-6">Build Your Perfect Freelance Portfolio</h1>
                    <p class="text-xl mb-8">Showcase your work, attract clients, and grow your business with our easy-to-use portfolio builder.</p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true): ?>
                            <a href="signup.php" class="bg-white text-indigo-600 px-6 py-3 rounded-md text-lg font-semibold hover:bg-gray-100 transition duration-300 text-center">Start Building - It's Free</a>
                        <?php endif; ?>
                        <button class="border-2 border-white text-white px-6 py-3 rounded-md text-lg font-semibold hover:bg-white hover:text-indigo-600 transition duration-300">View Examples</button>
                    </div>
                </div>
                <div class="md:w-1/2 relative">
                    <div class="bg-white rounded-xl shadow-2xl overflow-hidden transform rotate-3">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Portfolio example" class="w-full h-auto">
                    </div>
                    <div class="absolute -bottom-6 -left-6 bg-indigo-500 rounded-xl w-32 h-32 -z-10"></div>
                    <div class="absolute -top-6 -right-6 bg-purple-500 rounded-xl w-32 h-32 -z-10"></div>
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Everything You Need to Stand Out</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Our platform provides all the tools to create a professional portfolio that gets you noticed.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-8 rounded-xl hover:shadow-lg transition duration-300">
                    <div class="bg-indigo-100 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-magic text-indigo-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Beautiful Templates</h3>
                    <p class="text-gray-600">Choose from dozens of professionally designed templates that showcase your work in the best light.</p>
                </div>
                
                <div class="bg-gray-50 p-8 rounded-xl hover:shadow-lg transition duration-300">
                    <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-sliders-h text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Easy Customization</h3>
                    <p class="text-gray-600">Change colors, fonts, layouts with our intuitive editor. No coding skills required.</p>
                </div>
                
                <div class="bg-gray-50 p-8 rounded-xl hover:shadow-lg transition duration-300">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-mobile-alt text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Fully Responsive</h3>
                    <p class="text-gray-600">Your portfolio will look amazing on any device, from desktop to mobile.</p>
                </div>
                
                <div class="bg-gray-50 p-8 rounded-xl hover:shadow-lg transition duration-300">
                    <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-chart-line text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Built-in Analytics</h3>
                    <p class="text-gray-600">Track visitors, see what projects get the most attention, and optimize your portfolio.</p>
                </div>
                
                <div class="bg-gray-50 p-8 rounded-xl hover:shadow-lg transition duration-300">
                    <div class="bg-yellow-100 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-envelope text-yellow-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Contact Forms</h3>
                    <p class="text-gray-600">Let potential clients reach you directly with customizable contact forms.</p>
                </div>
                
                <div class="bg-gray-50 p-8 rounded-xl hover:shadow-lg transition duration-300">
                    <div class="bg-red-100 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-globe text-red-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Custom Domain</h3>
                    <p class="text-gray-600">Use your own domain name for a truly professional online presence.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="templates" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Stunning Portfolio Templates</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Browse our collection of handcrafted templates designed for every type of freelancer.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <a href="template1_minimal.html" class="portfolio-item bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition duration-300 block relative group">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1499951360447-b19be8fe80f5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Minimal template" class="w-full h-64 object-cover">
                    <div class="portfolio-overlay absolute inset-0 bg-indigo-600 bg-opacity-90 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                        <button type="button" class="preview-template-btn bg-white text-indigo-600 px-6 py-2 rounded-md font-medium" data-template-src="template1_minimal.html" onclick="event.preventDefault();">Preview</button>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Minimal</h3>
                    <p class="text-gray-600 mb-4">Clean and simple design that puts your work front and center.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Best for: Designers, Photographers</span>
                        </div>
                </div>
            </a>

            <a href="template2_creative.html" class="portfolio-item bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition duration-300 block relative group">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Creative template" class="w-full h-64 object-cover">
                    <div class="portfolio-overlay absolute inset-0 bg-purple-600 bg-opacity-90 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                        <button type="button" class="preview-template-btn bg-white text-purple-600 px-6 py-2 rounded-md font-medium" data-template-src="template2_creative.html" onclick="event.preventDefault();">Preview</button>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Creative</h3>
                    <p class="text-gray-600 mb-4">Bold and colorful layout that showcases your unique style.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Best for: Artists, Creatives</span>
                        </div>
                </div>
            </a>

            <a href="template3_professional.html" class="portfolio-item bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition duration-300 block relative group">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1467232004584-a241de8bcf5d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1469&q=80" alt="Professional template" class="w-full h-64 object-cover">
                    <div class="portfolio-overlay absolute inset-0 bg-blue-600 bg-opacity-90 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                        <button type="button" class="preview-template-btn bg-white text-blue-600 px-6 py-2 rounded-md font-medium" data-template-src="template3_professional.html" onclick="event.preventDefault();">Preview</button>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Professional</h3>
                    <p class="text-gray-600 mb-4">Sophisticated layout perfect for consultants and business services.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Best for: Consultants, Developers</span>
                        </div>
                </div>
            </a>
        </div>
    </div>
</section>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:space-x-12">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Build Your Portfolio in Minutes</h2>
                    <p class="text-gray-600 mb-8">Our intuitive editor makes it easy to create a stunning portfolio without any technical skills. Just pick a template, add your content, and publish!</p>
                    
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-indigo-100 rounded-full p-2 mr-4">
                                <i class="fas fa-check text-indigo-600"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900">Drag & Drop Editor</h4>
                                <p class="text-gray-600">Rearrange sections with simple drag and drop functionality.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-indigo-100 rounded-full p-2 mr-4">
                                <i class="fas fa-check text-indigo-600"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900">Live Preview</h4>
                                <p class="text-gray-600">See changes instantly as you edit your portfolio.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="flex-shrink-0 bg-indigo-100 rounded-full p-2 mr-4">
                                <i class="fas fa-check text-indigo-600"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900">One-Click Publishing</h4>
                                <p class="text-gray-600">Go live with a single click when you're ready.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="md:w-1/2 relative">
                    <div class="bg-gray-100 rounded-xl p-6 shadow-lg">
                        <div class="mb-6">
                            <h3 class="text-xl font-semibold text-gray-900 mb-4">Create Your Portfolio</h3>
                            
                            <div class="mb-4">
                                <div class="relative">
                                    <input type="text" id="portfolio-name" class="animated-input w-full px-4 py-2 border-b-2 border-gray-300 focus:border-indigo-600 outline-none bg-transparent" placeholder=" ">
                                    <label for="portfolio-name" class="absolute left-4 top-2 text-gray-500 transition-all duration-300">Portfolio Name</label>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <div class="relative">
                                    <input type="text" id="portfolio-url" class="animated-input w-full px-4 py-2 border-b-2 border-gray-300 focus:border-indigo-600 outline-none bg-transparent" placeholder=" ">
                                    <label for="portfolio-url" class="absolute left-4 top-2 text-gray-500 transition-all duration-300">Custom URL</label>
                                </div>
                            </div>
                            
                            <div class="mb-6">
                                <label class="block text-gray-700 mb-2">Select Template</label>
                                <div class="grid grid-cols-3 gap-2">
                                    <button class="border-2 border-gray-200 rounded p-2 hover:border-indigo-500">
                                        <img src="https://images.unsplash.com/photo-1499951360447-b19be8fe80f5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Template 1" class="w-full h-16 object-cover">
                                    </button>
                                    <button class="border-2 border-gray-200 rounded p-2 hover:border-indigo-500">
                                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Template 2" class="w-full h-16 object-cover">
                                    </button>
                                    <button class="border-2 border-gray-200 rounded p-2 hover:border-indigo-500">
                                        <img src="https://images.unsplash.com/photo-1467232004584-a241de8bcf5d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1469&q=80" alt="Template 3" class="w-full h-16 object-cover">
                                    </button>
                                </div>
                            </div>
                            
                            <button class="w-full bg-indigo-600 text-white py-3 rounded-md font-medium hover:bg-indigo-700 transition duration-300">Create Portfolio</button>
                        </div>
                    </div>
                    
                    <div class="absolute -bottom-6 -right-6 bg-indigo-100 rounded-xl w-32 h-32 -z-10"></div>
                </div>
            </div>
        </div>
    </section>

    <section id="testimonials" class="py-20 bg-indigo-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Trusted by Thousands of Freelancers</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">See how PortfolioCraft has helped freelancers land more clients and grow their businesses.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-xl shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400 text-xl mr-1">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-6">"PortfolioCraft made it so easy to showcase my photography work. I landed three new clients within a week of publishing my portfolio!"</p>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/women/43.jpg" alt="Sarah J." class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-medium text-gray-900">Sarah J.</h4>
                            <p class="text-gray-600">Photographer</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-8 rounded-xl shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400 text-xl mr-1">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-6">"As a developer, I didn't want to spend time coding my portfolio. PortfolioCraft gave me a professional site in under an hour."</p>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Michael T." class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-medium text-gray-900">Michael T.</h4>
                            <p class="text-gray-600">Web Developer</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-8 rounded-xl shadow-md">
                    <div class="flex items-center mb-4">
                        <div class="text-yellow-400 text-xl mr-1">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-6">"The analytics helped me understand what projects clients were most interested in. I doubled my rates within 3 months!"</p>
                    <div class="flex items-center">
                        <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="Lisa M." class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-medium text-gray-900">Lisa M.</h4>
                            <p class="text-gray-600">Graphic Designer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

   

    <section class="gradient-bg text-white py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Ready to Build Your Portfolio?</h2>
            <p class="text-xl mb-8">Join thousands of freelancers who've transformed their business with a professional portfolio.</p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true): ?>
                    <a href="signup.php" class="bg-white text-indigo-600 px-8 py-4 rounded-md text-lg font-semibold hover:bg-gray-100 transition duration-300 text-center">Start Building - It's Free</a>
                <?php endif; ?>
                <button class="border-2 border-white text-white px-8 py-4 rounded-md text-lg font-semibold hover:bg-white hover:text-indigo-600 transition duration-300">Schedule a Demo</button>
            </div>
        </div>
    </section>

    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-5 gap-8">
                <div class="col-span-2">
                    <div class="flex items-center mb-4">
                        <i class="fas fa-palette text-indigo-400 text-2xl mr-2"></i>
                        <span class="text-xl font-bold">PortfolioCraft</span>
                    </div>
                    <p class="text-gray-400 mb-4">The easiest way to create a professional freelance portfolio that gets you hired.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-sm font-semibold text-gray-300 uppercase tracking-wider mb-4">Product</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-white">Features</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Templates</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Examples</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-sm font-semibold text-gray-300 uppercase tracking-wider mb-4">Resources</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-white">Blog</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Help Center</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Tutorials</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Community</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-sm font-semibold text-gray-300 uppercase tracking-wider mb-4">Company</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-white">About</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Careers</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Contact</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Press</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm">? 2023 PortfolioCraft. All rights reserved.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="text-gray-400 hover:text-white text-sm">Privacy Policy</a>
                    <a href="#" class="text-gray-400 hover:text-white text-sm">Terms of Service</a>
                    <a href="#" class="text-gray-400 hover:text-white text-sm">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <div id="previewModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center p-4 z-50 modal-hidden">
        <div class="bg-white rounded-xl max-w-4xl w-full max-h-screen overflow-auto">
            <div class="flex justify-between items-center border-b border-gray-200 p-4">
                <h3 class="text-xl font-semibold text-gray-900">Template Preview</h3>
                <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-6">
                <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="Template Preview" class="w-full rounded-lg">
            </div>
            <div class="border-t border-gray-200 p-4 flex justify-end">
                <button class="bg-indigo-600 text-white px-6 py-2 rounded-md font-medium hover:bg-indigo-700 mr-3">Use This Template</button>
                <button id="closeModal2" class="border border-gray-300 text-gray-700 px-6 py-2 rounded-md font-medium hover:bg-gray-50">Close</button>
            </div>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
        
        // Preview modal
        const previewButtons = document.querySelectorAll('.portfolio-overlay button');
        const previewModal = document.getElementById('previewModal');
        const closeModalButtons = document.querySelectorAll('#closeModal, #closeModal2');
        
        previewButtons.forEach(button => {
            button.addEventListener('click', () => {
                previewModal.classList.remove('modal-hidden');
                previewModal.classList.add('modal-visible');
                document.body.style.overflow = 'hidden';
            });
        });
        
        closeModalButtons.forEach(button => {
            button.addEventListener('click', () => {
                previewModal.classList.remove('modal-visible');
                previewModal.classList.add('modal-hidden');
                document.body.style.overflow = 'auto';
            });
        });
        
        // Close modal when clicking outside
        previewModal.addEventListener('click', (e) => {
            if (e.target === previewModal) {
                previewModal.classList.remove('modal-visible');
                previewModal.classList.add('modal-hidden');
                document.body.style.overflow = 'auto';
            }
        });
        
        // Animated input labels
        const animatedInputs = document.querySelectorAll('.animated-input');
        
        animatedInputs.forEach(input => {
            const label = input.nextElementSibling;
            
            // Check if input has value on page load
            if (input.value) {
                label.classList.add('transform', '-translate-y-6', 'scale-75');
                label.classList.add('text-indigo-600');
            }
        });
    </script>
</body>
</html>