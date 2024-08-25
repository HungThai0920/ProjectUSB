<?php
 include('includes/session.php');
 require('db.php');
// Lấy danh sách các yêu cầu mượn USB đã được phê duyệt
$card_number = $_SESSION['card_number'];
$query = "SELECT b.*, d.usb_name 
          FROM usb_borrowing b
          LEFT JOIN usb_devices d ON b.usb_id = d.usb_id
          WHERE b.card_number = '$card_number' AND b.purpose = 'download' AND b.borrowing_status = 'approved'";
$result = mysqli_query($conn, $query);

?>


<head>
    <link rel="stylesheet" type="text/css" href="public/assets/css/download_data.css">
</head>

<div style="margin: 0 auto; padding: 0 16px">

<?php
      include('includes/layout.php');
      ?>
      s
    <div class="container">
        <h2>Download Data</h2>

        <table>
            <tr>
                <th>USB ID</th>
                <th>Tên USB</th>
                <th>Tên file</th>
                <th>Web link</th>
                <th>Thời gian mượn</th>
                <th>Thao tác</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['usb_id']; ?></td>
                    <td><?php echo $row['usb_name']; ?></td>
                    <td><?php echo $row['file_name']; ?></td>
                    <td><?php echo $row['web_link']; ?></td>
                    <td><?php echo $row['borrow_time']; ?></td>
                    <td>
                        <a href="uploads/<?php echo $row['file_name']; ?>" download>Tải xuống</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
