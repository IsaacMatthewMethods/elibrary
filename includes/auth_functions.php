<?php
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function is_admin() {
    return is_logged_in() && $_SESSION['role'] === 'admin';
}

function redirect_if_logged_in() {
    if (is_logged_in()) {
        header("Location: /");
        exit();
    }
}

function redirect_if_not_admin() {
    if (!is_admin()) {
        header("Location: /auth/login.php");
        exit();
    }
}
?>