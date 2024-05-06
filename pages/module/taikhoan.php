<?php 
    include 'controller.php';
    $taikhoan=new taikhoan;
    if(isset($_REQUEST['them'])){
        $data=json_decode($_POST['dataJSON']);
        $result=$taikhoan->timtk($data->SDT);
        if(mysqli_num_rows($result)==0){
            $taikhoan->themtk($data);
            echo 'success';
        }
        else echo 'fail';
    }
    else if(isset($_REQUEST['delete'])){
        $data=$_GET["SDT"];
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
    else if(isset($_REQUEST['update'])){
        $data=json_decode($_POST['dataJSON']);
        $result=$taikhoan->suatk($data);
        if(mysqli_num_rows($result) >0){
            echo 1;
        }
    }
    else if(isset($_REQUEST['xoa'])){
        $data=$_REQUEST['SDT'];
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
    else if(isset($_REQUEST['get'])){
        $result=$taikhoan->dstaikhoan();
        $arraccount=array();
        if(mysqli_num_rows($result)>0){
            while($row=mysqli_fetch_assoc($result)){
                $arraccount[]=$row;
            }
        }
        echo json_encode($arraccount);
    }
?>