<?php 
    include 'controller.php';
    $donhang=new donhang;
    if(isset($_REQUEST['get'])){
        $data=$_REQUEST['dataJSON'];
        $data=json_decode($data);
        $flagHoaDon=$donhang->setHoadon($data);
        foreach($data->arr as $item){
            $flagChiTiet=$donhang->setChiTietDonHang($item);
        }
        if(mysqli_num_rows($flagHoaDon)>0){
            echo "sucsess";
        }
        else {
            echo "fail";
        }
    }
?>