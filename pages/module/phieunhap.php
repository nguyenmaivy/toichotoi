<?php 
    include './controller.php';
    $phieunhap=new phieunhap;
    $sanpham=new sanpham();
    if(isset($_REQUEST['row'])){
        $result=$phieunhap->CountRow();
        $row=mysqli_fetch_assoc($result);
        echo $row['total'];
    }
    else if(isset($_REQUEST['phieunhap'])){
        $data=$_REQUEST['phieunhap'];
        $data=json_decode($data);
        $phieunhap->LuuPhieuNhap($data);
    }
    if(isset($_REQUEST['chitietphieunhap'])){
        $data=$_REQUEST['chitietphieunhap'];
        $data=json_decode($data);
        foreach ($data as $value) {
            $phieunhap->LuuChiTiet($value);
            $sanpham->suasanpham($value->maSP,$value->GiaSP,$value->donGia);
        }
    }
?>