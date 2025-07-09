# **PortfolioCraft**

## **🌟 Overview**

**PortfolioCraft** is a dynamic web application designed to empower freelancers, developers, designers, and creatives to easily build and manage stunning online portfolios. With a focus on simplicity and powerful customization, PortfolioCraft helps users showcase their work, attract clients, and grow their professional presence without needing any coding skills.

This repository contains the core files for the PortfolioCraft application, including user authentication (signup, login, logout) and various customizable portfolio templates.

## **💡 Project Background**

This project was developed during a **6-week web development internship** under **Interpro**. The internship focused on practical application of web technologies to create a functional and user-friendly platform.

## **✨ Features**

* **User Authentication**: Secure signup and login system to manage individual portfolios.  
* **Multiple Templates**: Choose from a selection of professionally designed, responsive portfolio templates (Minimal, Creative, Professional).  
* **Easy Customization**: Intuitive editing features (demonstrated in template3\_professional.html with Alpine.js) to personalize content, colors, and layouts.  
* **Responsive Design**: All generated portfolios are fully responsive and look great on any device.  
* **Project & Skill Management**: Easily add, edit, and remove projects, skills, and certifications.  
* **Contact Forms**: Integrated contact sections to allow potential clients to reach out directly.  
* **Export Options**: (Planned/Partial) Ability to export portfolios (e.g., as HTML or PDF).

## **🚀 Technologies Used**

* **Backend**: PHP (for server-side logic, user authentication, and database interaction)  
* **Database**: MySQL (via MySQLi extension)  
* **Frontend**:  
  * HTML5  
  * CSS3 (with [Tailwind CSS](https://tailwindcss.com/) for utility-first styling)  
  * JavaScript  
  * [Alpine.js](https://alpinejs.dev/) (for interactive elements and dynamic content editing in template3\_professional.html)  
  * [AOS (Animate On Scroll)](https://michalsnik.github.io/aos/) (for scroll animations in template2\_creative.html)  
  * [Font Awesome](https://fontawesome.com/) (for icons)  
  * [html2pdf.js](https://html2pdf.com/) (for PDF export functionality in template2\_creative.html)

## **🛠️ Installation Guide**

To get PortfolioCraft up and running on your local machine, follow these steps:

### **Prerequisites**

* **Web Server**: Apache or Nginx (commonly provided by XAMPP, WAMP, MAMP, or LAMP stack).  
* **PHP**: Version 7.4 or higher.  
* **MySQL**: Database server.

### **1\. Clone the Repository**

git clone https://github.com/your-username/PortfolioCraft.git  
cd PortfolioCraft

### **2\. Database Setup**

1. Create a Database:  
   Open your MySQL client (e.g., phpMyAdmin, MySQL Workbench, or command line) and create a new database. Let's name it signup\_db (as specified in login.php and signup.php).  
   CREATE DATABASE signup\_db;  
   USE signup\_db;

2. Create the users Table:  
   Execute the following SQL query to create the users table:  
   CREATE TABLE users (  
       id INT AUTO\_INCREMENT PRIMARY KEY,  
       username VARCHAR(255) NOT NULL UNIQUE,  
       email VARCHAR(255) NOT NULL UNIQUE,  
       password VARCHAR(255) NOT NULL,  
       created\_at TIMESTAMP DEFAULT CURRENT\_TIMESTAMP  
   );

3. Update Database Credentials (if necessary):  
   Open login.php and signup.php. Verify and update the database connection details if they differ from your local setup:  
   // login.php and signup.php  
   $host \= 'localhost';          // Your database host  
   $db   \= 'signup\_db';         // Your actual database name (should be 'signup\_db')  
   $user \= 'root';               // Your database username  
   $pass \= '';                   // Your database password (e.g., '' for XAMPP default)

### **3\. Place Files on Your Web Server**

Move all the files from the cloned repository into your web server's document root (e.g., htdocs for XAMPP, www for WAMP).

Example path for XAMPP:  
C:\\xampp\\htdocs\\PortfolioCraft\\

### **4\. Access the Application**

Open your web browser and navigate to:

http://localhost/PortfolioCraft/signup.php

or

http://localhost/PortfolioCraft/login.php

You should see the signup or login page.

## **💡 Usage**

1. **Sign Up**: Create a new account using signup.php.  
2. **Log In**: Access your dashboard via login.php.  
3. **Build Your Portfolio**: Once logged in, you can explore portfolio.php which serves as the main entry point to select and customize your portfolio template.  
   * The template1\_minimal.html, template2\_creative.html, and template3\_professional.html files provide different starting points for your portfolio. template3\_professional.html includes an interactive editing experience using Alpine.js.  
4. **Log Out**: Use logout.php to end your session.

## **🤝 Contributing**

We welcome contributions to PortfolioCraft\! If you have suggestions for improvements, bug fixes, or new features, please follow these steps:

1. Fork the repository.  
2. Create a new branch (git checkout \-b feature/your-feature-name).  
3. Make your changes.  
4. Commit your changes (git commit \-m 'Add new feature').  
5. Push to the branch (git push origin feature/your-feature-name).  
6. Open a Pull Request.

## **📄 License**

This project is licensed under the MIT License \- see the LICENSE.md file for details.  
(Note: You'll need to create a LICENSE.md file in your repository if you choose this license.)  
Made with ❤️ by Your Name/Team