<?php 
    include './controller.php';
    $sanpham=new sanpham;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_REQUEST['id'])){
        $target_directory = "../../img/"; // Thư mục lưu trữ ảnh đã tải lên
        $masp=$_REQUEST['id'];
        $target_file = $target_directory . basename($_FILES["HinhAnh"]["name"]); // Đường dẫn của tệp ảnh
    
        // Di chuyển tệp ảnh từ thư mục tạm sang thư mục lưu trữ
        if (move_uploaded_file($_FILES["HinhAnh"]["tmp_name"], $target_file)) {
            echo $masp;
            $sanpham->UpdateAnh($masp,htmlspecialchars(basename($_FILES["HinhAnh"]["name"])));
        } 
    }
    else {
        $target_directory = "../../img/";
        $target_file = $target_directory . basename($_FILES["HinhAnh"]["name"]);
        move_uploaded_file($_FILES["HinhAnh"]["tmp_name"], $target_file);
    }
}
?>
