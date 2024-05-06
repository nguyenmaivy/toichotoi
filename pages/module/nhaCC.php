<?php  
    include './controller.php';
    $nhacc=new nhacungcap;
    $hoadon=new donhang;
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
    else if(isset($_REQUEST['hoadon'])){
        $result = $hoadon->thongkethang();
        $currentMonth = intval(date('n')); // Lấy tháng hiện tại, chuyển về dạng số nguyên (từ 1 đến 12)
        $array = array_fill(0, $currentMonth, 0); // Tạo mảng gồm các tháng từ 1 đến tháng hiện tại, tất cả có giá trị ban đầu là 0
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $month = intval($row['month']); // Lấy tháng từ dữ liệu
                if($month <= $currentMonth){ // Chỉ xử lý nếu tháng từ dữ liệu không lớn hơn tháng hiện tại
                    $array[$month - 1] = intval($row['total']); // Gán giá trị doanh thu cho tháng tương ứng
                }
            }
        }
        echo json_encode($array);
    }
    
    
    

