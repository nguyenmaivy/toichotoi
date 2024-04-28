<table class="table table-striped">
  <thead>
    <tr>
    <th scope='col'>Mã sản phẩm</th>
    <th scope='col'>Tên sản phẩm</th>
    <th scope='col'>Số lượng</th>
    <th scope='col'>Đơn giá</th>
    <th scope='col'>Tổng tiền</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <?php 
        include './module/controller.php';
        $phieunhap=new phieunhap;
        $id=$_REQUEST['id'];
        $result=$phieunhap->TimPhieuNhap($id);
        if(mysqli_num_rows($result)>0){
          $data="";
          while($row=mysqli_fetch_assoc($result)){
            $data.='<th scope="row">'.$row['MaSP'].'</th>
            <td>'.$row['TenSP'].'</td>
            <td>'.$row['soLuong'].'</td>
            <td>'.$row['donGia'].'</td>
            <td>'.$row['tongTien'].'</td>
          </tr>';
          }
          echo $data;
        }
      ?>
      
  </tbody>
</table>