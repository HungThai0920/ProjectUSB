<?php
$target_dir = "Upload/"; // Thư mục lưu file upload
$target_file = $target_dir . basename($_FILES["fileToUpload"]["file_name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Kiểm tra xem file có phải là một hình ảnh thật hay không
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Kiểm tra nếu file đã tồn tại
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Giới hạn kích thước file (ví dụ: 5MB)
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Cho phép một số định dạng file nhất định
//if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
//&& $imageFileType != "gif" ) {
 //   echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
 //   $uploadOk = 0;
//}

// Kiểm tra nếu $uploadOk là 0 vì lỗi
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// Nếu mọi thứ đều ổn, cố gắng upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
