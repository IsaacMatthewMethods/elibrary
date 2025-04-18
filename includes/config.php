<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'elibrary_db');

// Site configuration
define('SITE_NAME', 'KadPoly eLibrary');
define('SITE_THEME', '#1a5e1a'); // Kaduna Polytechnic green
define('MAX_FILE_SIZE', 10 * 1024 * 1024); // 10MB

// Start session
session_start();

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Create database connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>