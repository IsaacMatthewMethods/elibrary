<?php
include '../includes/config.php';
include '../includes/auth_functions.php';

redirect_if_logged_in();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $conn = get_db_connection();
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);
    
    if ($stmt->execute()) {
        header("Location: login.php?registered=1");
        exit();
    } else {
        $error = "Registration failed. Username/email may already exist.";
    }
}
?>

<!-- Registration form (similar structure to login.php) -->