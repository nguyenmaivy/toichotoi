<?php 
    include 'controller.php';
    $taikhoan=new taikhoan;
    if(isset($_REQUEST['them'])){
        $data=json_decode($_POST['dataJSON']);
        $result=$taikhoan->timtk($data->user1_register);
        if(mysqli_num_rows($result)==0){
            $taikhoan->themtk($data);
            echo 1;
        }
        else echo 2;
    }
    else if(isset($_REQUEST['xoa'])){
        $data=$_GET["user1_register"];
        $result=$taikhoan->xoatk($data);
        if(mysqli_num_rows($result)>0){
            echo 1;
        }
        else echo 2;
    }
    else if(isset($_REQUEST['tim'])){
        $data=$_REQUEST['user1_register'];
        $status=$_REQUEST['status'];
        $result=$taikhoan->timtk($data);
        if(mysqli_num_rows($result)>0){
            $data=mysqli_fetch_assoc($result);
            $data['status']=$status;
            $data=json_encode($data);
            echo $data;
        }
    }
    else if(isset($_REQUEST['sua'])){
        $data=json_decode($_POST['dataJSON']);
        $result=$taikhoan->suatk($data);
        if(mysqli_num_rows($result) >0){
            echo 1;
        }
    }
    else if(isset($_REQUEST['xoa'])){
        $data=$_REQUEST['user1_register'];
        $result=$taikhoan->xoatk($data);
        if(mysqli_num_rows($result)>=0){
            echo 1;
        }
    }
    else if(isset($_REQUEST['suaquyen'])){
        $data=$_REQUEST['data'];
        $data=json_decode($data);
        $result=$taikhoan->suaquyen($data);
        echo $result;
    }
?>