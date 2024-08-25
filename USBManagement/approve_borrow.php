<?php
 include('includes/session.php');
 require('db.php');

// Lấy danh sách các yêu cầu mượn USB chưa được duyệt
$query = "SELECT b.*, u.user_name, u.department, d.usb_name 
          FROM usb_borrowing b
          LEFT JOIN users u ON b.card_number = u.card_number
          LEFT JOIN usb_devices d ON b.usb_id = d.usb_id
          WHERE b.borrowing_status = 'pending'";
$result = mysqli_query($conn, $query);

?> 


<head>
    <link rel="stylesheet" type="text/css" href="public/assets/css/approve_borrow.css">
</head>

<div style="margin: 0 auto; padding: 0 16px">

<?php
      include('includes/layout.php');
      ?>

    <div class="container">
        <h2>Phê duyệt USB</h2>

        <table>
            <tr>
                <th>USB ID</th>
                <th>Tên USB</th>
                <th>Tên người mượn</th>
                <th>Bộ phận người mượn</th>
                <th>Mục đích mượn</th>
                <th>Tên file</th>
                <th>Web link</th>
                <th>Thời gian mượn</th>
                <th>Thao tác</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['usb_id']; ?></td>
                    <td><?php echo $row['usb_name']; ?></td>
                    <td><?php echo $row['user_name']; ?></td>
                    <td><?php echo $row['department']; ?></td>
                    <td><?php echo $row['purpose']; ?></td>
                    <td><?php echo $row['file_name']; ?></td>
                    <td><?php echo $row['web_link']; ?></td>
                    <td><?php echo $row['borrow_time']; ?></td>
                    <td>
                        <form method="post" action="process_borrow.php">
                            <input type="hidden" name="borrowing_id" value="<?php echo $row['borrowing_id']; ?>">
                            <button type="submit" name="approve_borrow">Xác nhận mượn</button>
                            <button type="submit" name="approve_return">Xác nhận trả</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
