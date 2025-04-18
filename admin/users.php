<?php
include '../../includes/config.php';
include '../../includes/auth_functions.php';

redirect_if_not_admin();

// Handle user management actions
if (isset($_GET['action'])) {
    // Process actions (delete, promote, etc.)
}

// Fetch all users
$users = $conn->query("SELECT * FROM users");
?>

<!-- User management table -->