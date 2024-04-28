<?php  
    include './controller.php';
    $sanpham=new sanpham;
    if(isset($POST['data'])){
        $data=$_POST['data']; 
        $data=json_decode($data); // lấy dữ liệu từ client g
        $result=$sanpham->search($data);
        $result=json_encode($result,true);  //
        echo  $result;
    }
    else if(isset($_REQUEST['xoa'])){
        $masp=$_REQUEST['xoa'];
        $result=$sanpham->xoasanpham($masp);
        return $result;
    }
    else if(isset($_REQUEST['suasp'])){
        
        $data=$_REQUEST['dataJSON'];
        $data=json_decode($data);
        $result=$sanpham->suasanpham($data);
        echo $result;
    }
    

