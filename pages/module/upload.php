<?php 
    include './connect.php';
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_directory = "../../img/"; // Thư mục lưu trữ ảnh đã tải lên
    $target_file = $target_directory . basename($_FILES["HinhAnh"]["name"]); // Đường dẫn của tệp ảnh

    // Di chuyển tệp ảnh từ thư mục tạm sang thư mục lưu trữ
    if (move_uploaded_file($_FILES["HinhAnh"]["tmp_name"], $target_file)) {
        echo htmlspecialchars(basename($_FILES["HinhAnh"]["name"])); 
    } 
}
?>
