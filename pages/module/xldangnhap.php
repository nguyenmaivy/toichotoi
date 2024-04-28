<?php 
    include './controller.php';
    $taikhoan=new taikhoan;
    $ussename=$_REQUEST['user_login'];
    $passpwd=$_REQUEST['password_login'];
    //Khởi tạo biến data để trả dữ liệu phản hồi
    $data=array(
        'flag' =>false,
        'name' =>'',
        'quyen'=>''
    );
    // echo $strSQL;
    $result=$taikhoan->timtk($ussename);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
            if($row['MatKhau']==$passpwd){
                $data['flag']=true;
                $data['name']=$row['UserName'];
                $data['quyen']=$row['TenNhomQuyen'];
                $data['diachi']=$row['DiaChi'];
                $data['SDT']=$row['SDT'];
            }
        }
    echo json_encode($data);
?>