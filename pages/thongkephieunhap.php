<div class="table-content">
<table class="table table-striped">
  <thead>
    <tr>
    <th scope='col' style="width:100px">Mã phiếu nhập</th>
    <th scope='col'>Nhà cung cấp</th>
    <th scope='col'>Ngày lập</th>
    <th scope='col'>Tổng tiền</th>
    <th scope='col'>Thao tác</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <?php 
        include './module/controller.php';
        $phieunhap=new phieunhap;
        $result=$phieunhap->DSPhieuNhap();
        if(mysqli_num_rows($result)>0){
          $data="";
          while($row=mysqli_fetch_assoc($result)){
            $data.='<th scope="row" >'.$row['maPhieuNhap'].'</th>
            <td>'.$row['TenNCC'].'</td>
            <td>'.$row['ngayLap'].'</td>
            <td>'.$row['tongTien'].'</td>
            <td>
              <button class="btn btn-info" onclick="xemchitietnhap('.$row['maPhieuNhap'].')">Xem chi tiết</button>
              <button class="btn btn-info" onclick="inphieunhap('.$row['maPhieuNhap'].')">In phiếu nhập</button>
            </td>
          </tr>';
          }
          echo $data;
        }
      ?>
      
  </tbody>
</table>
</div>