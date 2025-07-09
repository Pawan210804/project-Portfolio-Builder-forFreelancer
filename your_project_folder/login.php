<?php
// login.php - This file handles both the display of the login form and its processing logic.

// -------------------------------------------------------------------------
// PHP Error Reporting Configuration (for development only)
// These lines MUST be at the very top of your script to catch all errors.
// REMOVE or restrict these in a production environment for security.
// -------------------------------------------------------------------------
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start a session to manage user login state and messages across pages.
session_start();

// -------------------------------------------------------------------------
// Database Connection Details for XAMPP (MySQLi)
// IMPORTANT: These should match the credentials used in your signup.php.
// Update 'your_database_name' with your actual database name.
// -------------------------------------------------------------------------
$host = 'localhost';          // Your database host (usually 'localhost' for XAMPP)
$db   = 'signup_db';         // <--- IMPORTANT: Change this to your actual database name
$user = 'root';               // Your database username (default for XAMPP is 'root')
$pass = '';                   // Your database password (default for XAMPP is empty)

// Enable MySQLi error reporting for better debugging of database issues.
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Initialize database connection variable outside the try-catch block
$conn = null;

try {
    $conn = new mysqli($host, $user, $pass, $db);
    // Set charset to utf8mb4 for better character encoding support
    $conn->set_charset("utf8mb4");
} catch (mysqli_sql_exception $e) {
    // Log the error to a file (for production) and display a user-friendly message
    error_log("Failed to connect to MySQL: " . $e->getMessage());
    $_SESSION['error_message'] = "Database connection failed. Please try again later.";
    // If connection fails, redirect back to login or an error page.
    header("Location: login.php"); // Or an error page if you have one
    exit();
}

$login_error = ''; // Initialize error message variable

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // This variable will hold either the username or email entered by the user
    $username_or_email = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Basic validation (more robust validation should be done on both client and server sides)
    if (empty($username_or_email) || empty($password)) {
        $login_error = "Please enter both username/email and password.";
    } else {
        // Prepare a SQL statement to prevent SQL injection
        // Search for the user by either username OR email
        // This is the CRITICAL CHANGE: added 'OR email = ?'
        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ? OR email = ?");
        // Bind the input variable twice, once for username and once for email
        $stmt->bind_param("ss", $username_or_email, $username_or_email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($id, $db_username, $hashed_password);
            $stmt->fetch();

            // Verify password
            if (password_verify($password, $hashed_password)) {
                // Password is correct, create session variables
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $id; // Store user ID in session
                $_SESSION['username'] = $db_username; // Store username in session
                
                // Set a success message (optional)
                $_SESSION['success_message'] = "Login successful! Welcome, " . htmlspecialchars($db_username) . "!";

                // Redirect to the desired HTML page (e.g., portfolio.php)
                // IMPORTANT: Make sure 'portfolio.php' is in the same directory as login.php
                header("Location: portfolio.php"); // Ensure this points to your .php file
                exit(); // Always call exit() after a header redirect
            } else {
                $login_error = "Invalid username or password."; // Password mismatch
            }
        } else {
            $login_error = "Invalid username or password."; // No user found with provided username/email
        }

        $stmt->close();
    }
}

// Close the database connection if it was successfully opened
if ($conn) {
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to PortfolioCraft</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .form-input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.5); /* blue-500 with opacity */
            border-color: transparent; /* Remove default border */
        }
        .login-button:hover {
            transform: scale(1.02); /* Slightly less dramatic hover for buttons */
        }
    </style>
</head>
<body class="font-sans gradient-bg min-h-screen flex items-center justify-center p-4">
    <div class="login-container bg-white rounded-xl shadow-2xl p-8 max-w-md w-full">
        <div class="text-center mb-8">
            <i class="fas fa-user-circle text-blue-600 text-5xl mb-4"></i>
            <h2 class="text-3xl font-bold text-gray-900">Welcome Back!</h2>
            <p class="text-gray-600">Log in to manage your portfolio</p>
        </div>

        <?php
        // Display error message if any
        if (!empty($login_error)) {
            echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">';
            echo '<strong class="font-bold">Error!</strong>';
            echo '<span class="block sm:inline"> ' . htmlspecialchars($login_error) . '</span>';
            echo '</div>';
        }
        // Display success message from session after redirect (e.g., from signup.php)
        if (isset($_SESSION['success_message'])) {
            echo '<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">';
            echo '<strong class="font-bold">Success!</strong>';
            echo '<span class="block sm:inline"> ' . htmlspecialchars($_SESSION['success_message']) . '</span>';
            echo '</div>';
            unset($_SESSION['success_message']); // Clear the message after displaying
        }
        ?>

        <form action="login.php" method="POST" class="space-y-6">
            <div>
                <label for="username" class="form-label block text-gray-700 text-sm font-semibold mb-2">Username or Email</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    placeholder="Your username or email"
                    class="form-input shadow-sm appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out"
                    required
                />
            </div>

            <div>
                <label for="password" class="form-label block text-gray-700 text-sm font-semibold mb-2">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter your password"
                    class="form-input shadow-sm appearance-none border rounded-lg w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out"
                    required
                />
            </div>

            <div>
                <button
                    type="submit"
                    class="login-button w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-200 ease-in-out transform hover:scale-105"
                >
                    Log In
                </button>
            </div>
        </form>

        <p class="signup-prompt text-center text-gray-600 text-sm mt-6">
            Don't have an account?
            <a href="signup.php" class="signup-link text-blue-600 hover:text-blue-800 font-semibold transition duration-200 ease-in-out">Sign up here</a>
        </p>
    </div>
</body>
</html>