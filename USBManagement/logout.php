<?php
session_start(); // Bắt đầu phiên làm việc

// Hủy tất cả các biến phiên làm việc
$_SESSION = array();

// Nếu bạn muốn hủy cả phiên làm việc, hãy hủy cả cookie phiên làm việc.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Cuối cùng, hủy phiên làm việc
session_destroy();

// Điều hướng về trang đăng nhập
header('Location: login.php');
exit;
?>
