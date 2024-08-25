<?php
session_start();

if (isset($_POST['login'])) {
    require('db.php');
    
    $username = mysqli_real_escape_string($conn, $_POST['user_name']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $hashed_password = hash('sha256', $password); // Mã hóa mật khẩu

    //$query = "SELECT * FROM users WHERE username='$username' AND password='$hashed_password'";
    $query = "SELECT * FROM users WHERE user_name='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['card_number'] = $row['card_number'];
        $_SESSION['user_name'] = $row['user_name'];
        $_SESSION['access_level'] = $row['access_level'];
        header('Location: menu.php'); // Chuyển hướng đến trang menu sau khi đăng nhập thành công
        exit();
    } else {
        $error_msg = "Tên đăng nhập hoặc mật khẩu không đúng!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="public/assets/css/login.css">
</head>
<body>
    <div class="login-container">
        <h2>Đăng nhập</h2>
        <form method="post" action="">
            <div class="input-group">
                <img src="public/assets/images/user.png" alt="User Icon">
                <input type="text" name="user_name" placeholder="Tên đăng nhập" required>
            </div>
            <div class="input-group">
                <img src="public/assets/images/password.png" alt="Lock Icon">
                <input type="password" name="password" placeholder="Mật khẩu" required>
            </div>
            <button type="submit" name="login">
                <img src="public/assets/images/login.png" alt="Login Icon"> Đăng nhập
            </button>
        </form>
        <?php if (isset($error_msg)) echo "<p class='error-msg'>$error_msg</p>"; ?>
    </div>
</body>
</html>

