<?php
// Kiểm tra xem có yêu cầu gửi form và nút approve_borrow được nhấn không
if (isset($_POST['approve_borrow'])) {
    // Thực hiện kết nối đến cơ sở dữ liệu
    session_start();
    require('db.php');

    // Kiểm tra đăng nhập
    if (!isset($_SESSION['card_number'])) {
    header('Location: login.php');
    exit();
    }

    // Kiểm tra kết nối có thành công không
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Lấy dữ liệu từ form (ví dụ: ID mượn)
   // $borrow_id = $_POST['approve_borrow']; // Thay 'borrow_id' bằng tên trường thực tế

    // Cập nhật cơ sở dữ liệu
    $sql = "UPDATE usb_borrowing SET borrowing_status = 'Approved' ";

    if ($conn->query($sql) === TRUE) {
        echo "Cập nhật thành công";
    } else {
        echo "Lỗi: " . $conn->error;
    }

    // Đóng kết nối đến cơ sở dữ liệu
    $conn->close();
    // Chuyển hướng người dùng về trang duyệt upload data sau khi xử lý thành công
    header('Location: approve_borrow.php');
    exit();
}
?>
