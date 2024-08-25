<?php

// Thay đổi các thông số kết nối tới MySQL của bạn
$servername = "localhost"; // Tên server MySQL
$username = "root"; // Tên đăng nhập MySQL
$password = ""; // Mật khẩu MySQL
$dbname = "USB_Management"; // Tên cơ sở dữ liệu MySQL

// Tạo kết nối tới MySQL
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối đến MySQL thất bại: " . mysqli_connect_error());
}

?>
