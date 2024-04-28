<?php 
    require_once 'controller.php';
    global $danhmuc;
    function getDanhMuc(){
        $data=array();
         $danhmuc=new danhmuc; 
        $result=$danhmuc->dsdanhmuc();
        if(mysqli_num_rows($result)>0){
            while($row=mysqli_fetch_assoc($result)){
                $data[]=$row;
            }
            return $data;
        }
        else {
            return 0;
        }
        
    }
?>