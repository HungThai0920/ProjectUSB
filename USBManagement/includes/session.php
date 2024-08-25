<?php
// Check if a session is already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (!isset($_SESSION['user_name'])) {
    // If not logged in, redirect to the login page
    header('Location: login.php');
    exit;
}

// Kiểm tra quyền truy cập
if ($_SESSION['access_level'] != 1) { // Giả sử quản trị viên có access_level = 1
    echo "Bạn không có quyền truy cập vào trang này!";
    exit();
}

// Get user information from the session
$username = $_SESSION['user_name']; // Change this to fetch the actual user information
?>
