<?php 
    include './controller.php';
    $taikhoan=new taikhoan;
    $data = json_decode($_POST['jsonData'], true);
    $taikhoan=new taikhoan;
    $result=$taikhoan->timtk($data['user1_register']);
    if($result->num_rows == 0){
        //Tạo tài khoản thôi
        $taikhoan->taotaikhoan($data);
        echo '1';
    }
    else {
        //Tài khoản tồn tại
        echo '0';
    }
?>