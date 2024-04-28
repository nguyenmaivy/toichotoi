<?php 
  require './module/controller.php';
  $banhang=new banhang;
  $sanpham=new sanpham;
    if(isset($_GET['day'])){
        //Báo cáo hôm nay
        $day=$_GET['day'];
        $arr=explode('-',$day);
        $data="<h3 class='text-center text-uppercase'>Báo cáo chi tiết hàng ngày</h3>
        <h6 class='text-center'>Ngày ".$arr[2]." tháng ".$arr[1]." năm ".$arr[0]."</h6>
        <table class='table table-hover'>
          <thead>
            <tr>
              <th scope='col'>Mã sản phẩm</th>
              <th scope='col'>Tên sản phẩm</th>
              <th scope='col'>Giá sản phẩm</th>
              <th scope='col'>Số lượng</th>
            </tr>
          </thead>
          <tbody>";
        $result=$banhang->ngay($day);
        $array=[];
        if(mysqli_num_rows($result)>0){
          while($row=mysqli_fetch_assoc($result)){
            if(!array_key_exists($row['MaSP'],$array)){
              //không tồn tại
              $array[$row['MaSP']] = $row['SoLuong'];
            }
            else {
              //Tồn tại
              $array[$row['MaSP']] += $row['SoLuong'];
            }
          }
        }
        $keys=array_keys($array);
        foreach($keys as $key){
          $result=$sanpham->sanpham($key);
          $row=mysqli_fetch_assoc($result);
          $data.="<tr>
          <td>".$key."</td>
          <td>".$row['TenSP']."</td>
          <td>".$row['GiaSP']."</td>
          <td>".$array[$row['MaSP']]."</td>
        </tr>";
        }
        $data.="</tbody>
        </table>";
        echo $data;
    }
    else if(isset($_GET['khoang'])){
        //Báo cáo theo khoảng thời gian
        $from=$_GET['from'];
        $arFrom=explode('-',$from);
        $to=$_GET['to'];
        $arTo=explode('-',$to);
        $data="<h3 class='text-center text-uppercase'>Báo cáo chi tiết hàng</h3>
        <h6 class='text-center'>Từ ngày ".$arFrom[2]."/".$arFrom[1]."/".$arFrom[0]." đến ".$arTo[2]."/".$arTo[1]."/".$arTo[0]."</h6>
        <table class='table table-hover'>
          <thead>
            <tr>
              <th scope='col'>Mã sản phẩm</th>
              <th scope='col'>Tên sản phẩm</th>
              <th scope='col'>Giá sản phẩm</th>
              <th scope='col'>Số lượng</th>
            </tr>
          </thead>
          <tbody>";
          $result=$banhang->khoangtime($from,$to);
          if(mysqli_num_rows($result)>0){
            $array=[];
            while($row=mysqli_fetch_assoc($result)){
              if(!array_key_exists($row['MaSP'],$array)){
                $array[$row['MaSP']]=$row['SoLuong'];
              }
              else {
                $array[$row['MaSP']]+=$row['SoLuong'];
              }
            }
          }
          $keys=array_keys($array);
          foreach($keys as $key ){
            $result=$sanpham->sanpham($key);
            $row=mysqli_fetch_assoc($result);
            $data.="<tr>
            <td>".$key."</td>
            <td>".$row['TenSP']."</td>
            <td>".$row['GiaSP']."</td>
            <td>".$array[$row['MaSP']]."</td>
            </tr>";
          }
          $data.="</tbody>
          </table>";
          echo $data;
    }
?>