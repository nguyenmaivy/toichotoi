<?php 
    include './controller.php';
    $taikhoan=new taikhoan;
    $data = json_decode($_POST['jsonData'], true);
    $result=$taikhoan->timtk($data['user1_register']);
    if($result->num_rows == 0){
        //Tạo tài khoản thôi
        $taikhoan->themtk($data);
        echo '1';
    }
    else {
        //Tài khoản tồn tại
        echo '0';
    }
?>