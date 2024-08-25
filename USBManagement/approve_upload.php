<?php
session_start();
require('db.php');

// Kiểm tra đăng nhập
if (!isset($_SESSION['card_name'])) {
    header('Location: login.php');
    exit();
}

// Xử lý duyệt upload data
if (isset($_POST['approve_upload'])) {
    $borrowing_id = mysqli_real_escape_string($conn, $_POST['borrowing_id']);

    // Cập nhật trạng thái của yêu cầu mượn trong bảng usb_borrowing
    $update_query = "UPDATE usb_borrowing SET borrowing_status = 'approved' WHERE borrowing_id = '$borrowing_id'";
    mysqli_query($conn, $update_query);

    // Lấy thông tin chi tiết của yêu cầu
    $query_details = "SELECT * FROM usb_borrowing WHERE borrowing_id = '$borrowing_id'";
    $result_details = mysqli_query($conn, $query_details);
    $row_details = mysqli_fetch_assoc($result_details);

    // Cập nhật trạng thái của USB trong bảng usb_devices
    $usb_id = $row_details['usb_id'];
    $update_usb_query = "UPDATE usb_devices SET usb_status = 'borrowed' WHERE usb_id = '$usb_id'";
    mysqli_query($conn, $update_usb_query);

    // Chuyển hướng người dùng về trang duyệt upload data sau khi xử lý thành công
    header('Location: approve_upload.php');
    exit();
}

// Xử lý từ chối upload data
if (isset($_POST['reject_upload'])) {
    $borrowing_id = mysqli_real_escape_string($conn, $_POST['borrowing_id']);

    // Cập nhật trạng thái của yêu cầu mượn trong bảng usb_borrowing
    $update_query = "UPDATE usb_borrowing SET borrowing_status = 'rejected' WHERE borrowing_id = '$borrowing_id'";
    mysqli_query($conn, $update_query);

    // Chuyển hướng người dùng về trang duyệt upload data sau khi xử lý thành công
    header('Location: approve_upload.php');
    exit();
}

?>
