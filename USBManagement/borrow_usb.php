<?php
include('includes/session.php');
require('db.php');

// Fetch USB information from the database
$query = "SELECT * FROM usb_devices";
$result = mysqli_query($conn, $query);

// Handle USB borrowing registration
if (isset($_POST['register_borrow'])) {
    $usb_id = mysqli_real_escape_string($conn, $_POST['usb_id']);
    $purpose = mysqli_real_escape_string($conn, $_POST['purpose']);
    $file_name = mysqli_real_escape_string($conn, $_POST['file_name']);
    $web_link = mysqli_real_escape_string($conn, $_POST['web_link']);

    // Validate purpose and required fields
    if (($purpose == 'upload' || $purpose == 'download') && (empty($file_name) || empty($web_link))) {
        $error_msg = "Vui lòng nhập tên file và web link!";
    } else {
        // Insert into usb_borrowing table
        $card_number = $_SESSION['card_number'];
        $borrow_time = date('Y-m-d H:i:s');
        $query = "INSERT INTO usb_borrowing (usb_id, card_number, purpose, file_name, web_link, borrow_time, borrowing_status)
                  VALUES ('$usb_id', '$card_number', '$purpose', '$file_name', '$web_link', '$borrow_time', 'pending')";
        mysqli_query($conn, $query);

        // Update the status of the USB in usb_devices table
        $update_query = "UPDATE usb_devices SET usb_status = 'borrowed' WHERE usb_id = '$usb_id'";
        mysqli_query($conn, $update_query);

        // Redirect after successful registration
        header('Location: borrow_usb.php');
        exit();
    }
}

// Handle USB return action
if (isset($_POST['return_usb'])) {
    $borrow_id = mysqli_real_escape_string($conn, $_POST['borrow_id']);

    // Update the borrowing record to mark it as returned
    $return_time = date('Y-m-d H:i:s');
    $query = "UPDATE usb_borrowing SET borrowing_status = 'Returned', return_time = '$return_time' WHERE id = '$borrow_id'";
    mysqli_query($conn, $query);

    // Update the status of the USB in usb_devices table to 'available'
    $update_query = "UPDATE usb_devices SET usb_status = 'available' WHERE usb_id = (SELECT usb_id FROM usb_borrowing WHERE id = '$borrow_id')";
    mysqli_query($conn, $update_query);

    // Redirect after successful return
    header('Location: borrow_usb.php');
    exit();
}

?>

<head>
    <link rel="stylesheet" type="text/css" href="public/assets/css/borrow_usb.css">
</head>
<div style="margin: 0 auto; padding: 0 16px">

<?php
      include('includes/layout.php');
      ?>

    <div class="container">
        <h2>Đăng ký mượn USB</h2>

        <form method="post" action="">
            <label>Chọn USB:</label>
            <select name="usb_id" required>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <option value="<?php echo $row['usb_id']; ?>"><?php echo $row['usb_name']; ?></option>
                <?php } ?>
            </select>

            <label>Mục đích mượn:</label>
            <select name="purpose" required>
                <option value="upload">Upload data</option>
                <option value="download">Download data</option>
                <option value="transfer">Internal transfer</option>
            </select>

            <label>Tên file:</label>
            <input type="text" name="file_name">

            <label>Web link:</label>
            <input type="text" name="web_link">

            <button type="submit" name="register_borrow">Đăng ký mượn</button>
        </form>

        <?php if (isset($error_msg)) { ?>
            <p class="error-msg"><?php echo $error_msg; ?></p>
        <?php } ?>
    </div>

    <div class="container">
        <h2>Trả USB</h2>
        <form method="post" action="">
            <label>Chọn USB:</label>
            <select name="borrow_id" required>
                <?php
                // Fetching borrowings that are still marked as borrowed
                $borrow_query = "SELECT * FROM usb_borrowing WHERE borrowing_status = 'pending' OR borrowing_status = 'borrowed'";
                $borrow_result = mysqli_query($conn, $borrow_query);
                while ($borrow_row = mysqli_fetch_assoc($borrow_result)) { ?>
                    <option value="<?php echo $borrow_row['id']; ?>">USB ID: <?php echo $borrow_row['usb_id']; ?> - Borrowed by Card: <?php echo $borrow_row['card_number']; ?></option>
                <?php } ?>
            </select>

            <button type="submit" name="return_usb">Trả USB</button>
        </form>
    </div>

</div>
