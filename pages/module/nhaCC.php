<?php  
    include './controller.php';
    $nhacc=new nhacungcap;
    if(isset($POST['data'])){
        $data=$_POST['data']; 
        $data=json_decode($data); 
        $result=$nhacc->search($data);
        $result=json_encode($result,true);
        echo  $result;
    }
    else if(isset($_REQUEST['xoanhacc'])){
        $mancc=$_REQUEST['xoanhacc'];
        $result=$nhacc->xoanhacc($mancc);
        return $result;
    }
    else if(isset($_REQUEST['suanhacc'])){
        
        $data=$_REQUEST['dataJSON'];
        $data=json_decode($data);
        $result=$nhacc->suanhacc($data);
        echo $result;
    }
    else if(isset($_REQUEST['them'])) {
        $data=$_REQUEST['dataJSON'];
        $data=json_decode($data);
        $result=$nhacc->themncc($data);

        // if($result->num_rows > 0){
        //     $row = $result->fetch_assoc();
        //     $toatalNCC = intval($row['total']);

        // } else {
        //     $toatalNCC=0;
        // }
        // $newMaNCC = $strSQL + 1;
        // return $result;
    }

