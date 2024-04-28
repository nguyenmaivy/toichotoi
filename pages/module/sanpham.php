<?php  
    include 'controller.php';
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
    else if(isset($_REQUEST['them'])){
        $data=$_REQUEST['dataJSON'];
        $data=json_decode($data);
        $result=$sanpham->ThemSP($data);
    }
    else if(isset($_REQUEST['tim'])){
        $data=$_REQUEST['data'];
        $result=$sanpham->timsanpham($data);
        if(mysqli_num_rows($result)==0){
            $result=$sanpham->sanpham($data);
        }
        echo json_encode($result,true);
    }
    else if(isset($_REQUEST['get'])){
        $data=$_REQUEST['id'];
        $result=$sanpham->sanpham($data);
        $row=mysqli_fetch_assoc($result);
        $data=null;
        $data['MaSP']=$row['MaSP'];
        $data['TenSP']=$row['TenSP'];
        $data['GiaSP']=$row['GiaSP'];
        echo json_encode($data);
    }
    

