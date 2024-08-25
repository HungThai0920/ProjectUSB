

<?php
 include('includes/session.php');
 require('db.php');
 include ('core/CRUD.php');


 $crud = new CRUD($conn);

 // Xử lý các chức năng Thêm / Xóa / Sửa USB
if (isset($_POST['add_usb'])) {
    // Xử lý thêm USB
   //  $usb_name = $_POST['usb_name'];
   //  $usb_status = $_POST['usb_status'];
   //  $stmt = $conn->prepare("INSERT INTO usb_devices (usb_name, usb_status) VALUES (?, ?)");
   //  $stmt->bind_param("ss", $usb_name, $usb_status);
   //  $stmt->execute();
   //  $stmt->close();

   $data = [
      'usb_name' => $_POST['usb_name'],
      'usb_status' => $_POST['usb_status']
  ];

  $crud->create('usb_devices', $data);

}

if (isset($_POST['delete_usb'])) {
//     // Xử lý xóa USB
//     $usb_id = $_POST['usb_id'];
//     $stmt = $conn->prepare("DELETE FROM usb_devices WHERE usb_id = ?");
//     $stmt->bind_param("i", $usb_id);
//     $stmt->execute();
//     $stmt->close();
$conditions = "usb_id = " . intval($_POST['usb_id']);
$crud->delete('usb_devices', $conditions);

}

if (isset($_POST['edit_usb'])) {
    // Xử lý sửa USB
   //  $usb_id = $_POST['usb_id'];
   //  $usb_name = $_POST['usb_name'];
   //  $usb_status = $_POST['usb_status'];
   //  $stmt = $conn->prepare("UPDATE usb_devices SET usb_name = ?, usb_status = ? WHERE usb_id = ?");
   //  $stmt->bind_param("ssi", $usb_name, $usb_status, $usb_id);
   //  $stmt->execute();
   //  $stmt->close();
    $data = [
      'usb_id' =>  $_POST['usb_id'],
      'usb_name' => $_POST['usb_name'],
      'usb_status' => $_POST['usb_status']
  ];
  $conditions = "usb_id = " . intval($_POST['usb_id']);
  $crud->update('usb_devices', $data, $conditions);
}

// Lấy danh sách USB từ database
// $query = "SELECT * FROM usb_devices";
// $result = $conn->query($query);

$usbs = $crud->read('usb_devices');



?> 


<head>
   <link rel="stylesheet" href="public/assets/css/manage_usb.css">
</head>
<div style="margin: 0 auto; padding: 0 16px">
   <?php
      include('includes/layout.php');
      ?>

    <!-- Toast -->
   <?php
     include 'library/toast_message/index.php';
      ?>

   
   <div class="container">
      <header>
      <h2>Quản lý USB</h2>
       <!-- Modal Section -->
      <summary>
         <div class="button-section">
            <div class="button-modal" id="button-show-modal">
               Thêm USB
            </div>
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
            <h1 id="modal-title">Thêm USB</h1>
         </div>
         <div class="details-modal-content">
            <form method="post" action="">
               <input type="hidden" name="usb_id" id="usb_id">
               <div class="form-group">
                  <label for="usb_name">Tên USB:</label>
                  <input type="text" id="usb_name" name="usb_name" required>
               </div>
               <div class="form-group">
                  <label for="usb_status">Trạng thái:</label>
                  <div class="custom-select" >
                     <select id="usb_status" name="usb_status">
                        <option value="ready">Ready</option>
                        <option value="borrowed">Borrowed</option>
                     </select>
                  </div>
               </div>
               <button type="submit" name="add_usb" id="modal-submit-button">Thêm</button>
               <button type="submit" name="edit_usb" id="edit-submit-button" style="display: none;">Sửa</button>
            </form>
         </div>
      </div>
       <!-- Modal Section -->

      <!-- Table Section -->
      <table>
         <thead>
            <tr>
               <th>USB ID</th>
               <th>Tên USB</th>
               <th>Trạng thái</th>
               <th>Thao tác</th>
            </tr>
         </thead>
         <tbody>
    <?php foreach ($usbs as $row) { ?>
    <tr>
        <td><?php echo htmlspecialchars($row['usb_id']); ?></td>
        <td><?php echo htmlspecialchars($row['usb_name']); ?></td>
        <td><?php echo htmlspecialchars($row['usb_status']); ?></td>
        <td>
            <form method="post" action="" class="action-form">
                <input type="hidden" name="usb_id" value="<?php echo htmlspecialchars($row['usb_id']); ?>">
                <button
                    class="edit-btn"
                    type="button" 
                    <?php if ($row['usb_status'] == 'borrowed') echo 'disabled'; ?>
                    data-row='<?php echo htmlspecialchars(json_encode($row)); ?>'
                    onclick="openEditModal(this)"
                >
                Edit
                </button>
                <button type="submit" name="delete_usb" class="delete-btn" <?php if ($row['usb_status'] == 'borrowed') echo 'disabled'; ?>>Delete</button>
            </form>
        </td>
    </tr>
    <?php } ?>
</tbody>
      </table>
       <!-- Table Section -->
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
      document.getElementById('modal-title').innerText = 'Thêm USB';
      document.getElementById('modal-submit-button').style.display = 'block';
      document.getElementById('edit-submit-button').style.display = 'none';   
    }else {
      document.getElementById('modal-title').innerText = 'Sửa USB';
      document.getElementById('modal-submit-button').style.display = 'none';
      document.getElementById('edit-submit-button').style.display = 'block';   
    }
  }


  function setEditModal(row) {
    document.getElementById('usb_id').value = row.usb_id ?? '';
    document.getElementById('usb_name').value = row.usb_name ?? '';
    document.getElementById('usb_status').value = row.usb_status ?? '';
    document.getElementById('modal-title').innerText = 'Sửa USB';
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

