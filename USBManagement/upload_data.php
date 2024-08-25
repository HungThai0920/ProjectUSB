<?php
 include('includes/session.php');
 require('db.php');

?>


<head>
    <link rel="stylesheet" type="text/css" href="public/assets/css/upload_data.css">
    <script>
        function updateFilePath(input) {
            var filePath = input.value;
            document.getElementById('file-path').value = filePath;
        }
    </script>
</head>
<div style="margin: 0 auto; padding: 0 16px">

<?php
      include('includes/layout.php');
      ?>
      
    <div class="container">
        <h1>Upload Data</h1>
        <form action="process_upload.php" method="post" enctype="multipart/form-data">
            <label for="file-upload">Chọn file để upload:</label>
            <input type="file" id="file-upload" name="file" onchange="updateFilePath(this)">
            
            <label for="file-path">Đường dẫn file:</label>
            <input type="text" id="file-path" name="file-path" readonly>
            
            <label for="purpose">Mục đích:</label>
            <select id="purpose" name="purpose">
                <option value="Data Up">Data Up</option>
                <option value="Data Down">Data Down</option>
                <option value="Internal Data">Internal Data</option>
                <option value="Scan Data">Scan Data</option>
            </select>
            
            <input type="submit" value="Upload">
        </form>
    </div>
</div>
