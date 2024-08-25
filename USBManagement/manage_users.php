<?php
 include('includes/session.php');
 require('db.php');
 include ('core/CRUD.php');

 $crud = new CRUD($conn);

// Xử lý các chức năng Thêm / Xóa / Sửa người dùng
if(isset($_POST['add_user'])) {
    // Kiểm tra và làm sạch dữ liệu đầu vào
   //  $card_number = isset($_POST['card_number']) ? $conn->real_escape_string($_POST['card_number']) : '';
   //  $user_name = isset($_POST['user_name']) ? $conn->real_escape_string($_POST['user_name']) : '';
   //  $department = isset($_POST['department']) ? $conn->real_escape_string($_POST['department']) : '';
   //  $email = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : '';
   //  $access_level = isset($_POST['access_level']) ? $conn->real_escape_string($_POST['access_level']) : '';

    $data = [
      'card_number' => $_POST['card_number'],
      'user_name' => $_POST['user_name'],
      'password' => $_POST['password'],
      'department' => $_POST['department'],
      'email' => $_POST['email'],
      'access_level' => $_POST['access_level'],
  ];

  $crud->create('users', $data);


   //  if ($card_number && $user_name && $department && $email) {
   //      $sql = "INSERT INTO Users (card_number, user_name, department, email, access_level) VALUES ('$card_number', '$user_name', '$department', '$email', 'access_level')";
   //      if ($conn->query($sql) === TRUE) {
   //          $message = "New user added successfully";
   //      } else {
   //          $message = "Error: " . $sql . "<br>" . $conn->error;
   //      }
   //  } else {
   //      $message = "All fields are required!";
   //  }
}

if (isset($_POST['delete_user'])) {
   $conditions = "card_number = " . intval($_POST['card_number']);
   $crud->delete('users', $conditions);
   
}

if (isset($_POST['edit_user'])) {
   $data = [
     'card_number' =>  $_POST['card_number'],
     'user_name' => $_POST['user_name'],
     'department' => $_POST['department'],
     'email' => $_POST['email'],
     'access_level' => $_POST['access_level'],
 ];
 $conditions = "card_number = " . intval($_POST['card_number']);
 $crud->update('users', $data, $conditions);
}

$users = $crud->read('users'); 

// Fetch users
// $sql = "SELECT * FROM Users";
// $result = $conn->query($sql);
// ?>

<head>
    <link rel="stylesheet" href="public/assets/css/manage_users.css">
</head>

<div style="margin: 0 auto; padding: 0 16px">

<?php
      include('includes/layout.php');
      ?>
<?php
     include 'library/toast_message/index.php';
      ?>      

    <div class="container">
        <header>
            <h1>Quản lý người dùng</h1>
        </header>
        <!-- Modal Section -->
        <summary>
         <div class="button-section">
            <div class="button-modal" id="button-show-modal">Thêm người dùng</div>
         </div>
         <div class="details-modal-overlay" id="modalOverlay" onclick="closeModal()"></div>
      </summary>
      <div class="details-modal" id="modal">
         <div class="details-modal-close" id="icon-close-modal" onclick="closeModal()">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
               <path fill-rule="evenodd" clip-rule="evenodd" d="M13.7071 1.70711C14.0976 1.31658 14.0976 0.683417 13.7071 0.292893C13.3166 -0.0976311 12.6834 -0.0976311 12.2929 0.292893L7 5.58579L1.70711 0.292893C1.31658 -0.0976311 0.683417 -0.0976311 0.292893 0.292893C-0.0976311 0.683417 -0.0976311 1.31658 0.292893 1.70711L5.58579 7L0.292893 12.2929C-0.0976311 12.6834 -0.0976311 13.3166 0.292893 13.7071C0.683417 14.0976 1.31658 14.0976 1.70711 13.7071L7 8.41421L12.2929 13.7071C12.6834 14.0976 13.3166 14.0976 13.7071 13.7071C14.0976 13.3166 14.0976 12.6834 13.7071 12.2929L8.41421 7L13.7071 1.70711Z" fill="black" />
            </svg>
         </div>
         <div class="details-modal-title">
            <h1 id="modal-title">Thêm người dùng</h1>
         </div>
         <div class="details-modal-content">
            <form method="post" action="">
               <div class="form-group">
                  <label for="card_number">Số thẻ:</label>
                  <input type="text" id="card_number" name="card_number" required>
               </div>
               <div class="form-group">
                  <label for="user_name">Tên người dùng:</label>
                  <input type="text" id="user_name" name="user_name" required>
               </div>
               <div class="form-group">
                  <label for="password">Mật khẩu:</label>
                  <input type="text" id="password" name="password" required>
               </div>
               <div class="form-group">
                  <label for="department">Phòng ban:</label>
                  <input type="text" id="department" name="department" required>
               </div>
               <div class="form-group">
                  <label for="email">email:</label>
                  <input type="text" id="email" name="email" required>
               </div>
               <div class="form-group">
                  <label for="access_level">cấp độ:</label>
                  <div class="custom-select" >
                     <select id="access_level" name="access_level">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                     </select>
                  </div>
               </div>
               <button type="submit" name="add_user" id="modal-submit-button">Thêm</button>
               <button type="submit" name="edit_user" id="edit-submit-button" style="display: none;">Sửa</button>
            </form>
         </div>
      </div>

        <!-- Table Section -->
        <h2>Danh sách người dùng</h2>
        <table>
            <thead>
                <tr>
                    <th>Card Number</th>
                    <th>User Name</th>
                    <th>Department</th>
                    <th>Email</th>
                    <!-- <th>Access Level</th> -->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $row) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['card_number']); ?></td>
                    <td><?php echo htmlspecialchars($row['user_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['department']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <!-- <td><?php echo htmlspecialchars($row['access_level']); ?></td> -->
                    <td>
                    <form method="post" action="" class="action-form">
                        <button type="submit" name="edit_user" id="edit-submit-button">Edit</button>
                        <button type="submit" name="delete_user" class="delete-btn">Delete</button>
                    </form>   
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>
</div>

<script>
  // Function to close the modal
  function closeModal() {
    document.getElementById('modal').style.display = 'none';
    document.getElementById('modalOverlay').style.display = 'none';
  }

   // Function to open the modal
   function openModal(type) {
    document.getElementById('modal').style.display = 'flex';
    document.getElementById('modalOverlay').style.display = 'block';
    if(type ==='new'){
      document.getElementById('modal-title').innerText = 'Thêm người dùng';
      document.getElementById('modal-submit-button').style.display = 'block';
      document.getElementById('edit-submit-button').style.display = 'none';   
    }else {
      document.getElementById('modal-title').innerText = 'Sửa thông tin';
      document.getElementById('modal-submit-button').style.display = 'none';
      document.getElementById('edit-submit-button').style.display = 'block';   
    }
  }


  function setEditModal(row) {
    document.getElementById('card_number').value = row.card_number ?? '';
    document.getElementById('user_name').value = row.user_name ?? '';
    document.getElementById('password').value = row.password ?? '';
    document.getElementById('department').value = row.department ?? '';
    document.getElementById('email').value = row.email ?? '';
    document.getElementById('access_level').value = row.access_level ?? '';
    document.getElementById('modal-title').innerText = 'Sửa thông tin';
    document.getElementById('modal-submit-button').style.display = 'none';
    document.getElementById('edit-submit-button').style.display = 'block';
  }

  // Show the modal when clicking the add usb button
  document.querySelector('#button-show-modal').addEventListener('click', function () {
    openModal('new')
  });



  function openEditModal(row) {
    const data = row.getAttribute("data-row");
    if(data){
      const dataParse = JSON.parse(data);
      openModal('edit');
      setEditModal(dataParse);
    }
  }

</script>

 

