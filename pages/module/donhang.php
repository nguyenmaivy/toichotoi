<?php 
    include 'controller.php';
    $donhang=new donhang;
    if(isset($_REQUEST['set'])){
        $data=$_REQUEST['dataJSON'];
        $data=json_decode($data);
        $flagHoaDon=$donhang->setHoadon($data);
        if(is_array($data->arr)){
            foreach($data->arr as $item){
                $flagChiTiet=$donhang->setChiTietDonHang($item);
            }
        }
        else {
            $flagChiTiet=$donhang->setChiTietDonHang($data->arr[0]);
        }
        if($flagHoaDon!=0){
            echo "sucsess";
        }
        else {
            echo "fail";
        }
    }
?>