<?php 
    function formatCurrency($price) {
        $price = (int) str_replace('.', '', $price);
        $result = '';
        while ($price >= 1000) {
            $remainder = $price % 1000;
            $result = '.' . sprintf("%03d", $remainder) . $result;
            $price = (int) ($price / 1000);
        }
        $result = $price . $result;
        return $result;
    }
    // include './connect.php';
    include './controller.php';
    $conn=new connect;
    $banhang=new banhang;
    $conn->constructor();
    $data="";
    if(!isset($_GET['chon'])){
        global $result;
        if(isset($_REQUEST['SDT'])){
            $SDT=$_REQUEST['SDT'];
            $result=$banhang->timtheoSDT($SDT);
            if(mysqli_num_rows($result)==0){
                $result=$banhang->timtheoID($SDT);
            }
        }
        else {
            $strtmp="";
            if(isset($_GET['from'])){
                $from=$_GET['from'];
                $to=$_GET['to'];
                $strtmp="AND NgayDatHang BETWEEN '".$from."' AND '".$to."'";
            }
            $strSQL="SELECT * FROM `donhang` WHERE TrangThaiDonHang='0' ".(!isset($_GET['status']) ? "OR TrangThaiDonHang='1'" : "").$strtmp;
            $result=$conn->excuteSQL($strSQL);
        }
        $data="<div class='table-content'><nav aria-label='breadcrumb'>
                        <ol class='breadcrumb'>
                        <li class='breadcrumb-item active'aria-current='page'>Đơn hàng</li>
                        </ol>
                    </nav>
                    <div class='float-start'><label for='form-time'>Từ ngày<input type='date' id='from-time'></label>
                    <label for='to-time'>Đến ngày<input type='date' id='to-time'></label>
                    <button onclick='handTimeDon()'>Lọc</button>
                    </div><input class='form-control me-1 search-donhang' type='search' placeholder='Nhập SĐT hoặc ID đơn' style='float: right;width: inherit' onkeypress='timdonhang(event)'>
                    <table class='table table-striped'>
                    <thead><tr><th>Mã đơn hàng</th>
                    <th>Ngày đặt hàng</th>
                    <th>Trạng thái đơn</th>
                    <th>Địa chỉ giao</th>
                    <th>Tổng tiền</th>
                    <th>Thao tác</th>
                    </tr></thead><tbody>";
        if(mysqli_num_rows($result)>0){
            while($row=mysqli_fetch_array($result)){
                $data.="<tr id='".$row['MaDonHang']."'>
                <td>".$row['MaDonHang']."</td>
                <td>".$row['NgayDatHang']."</td>
                <td class='tittle-status'>".($row['TrangThaiDonHang'] == "0" ? "Chưa duyệt" : "Đã duyệt")."</td>
                <td>".$row['DiaChiGiaoHang']."</td>
                <td>".formatCurrency($row['TongGiaTriDonHang'])." VNĐ</td>
                <td><button class='button-duyet ".($row['TrangThaiDonHang'] == "0" ? "active" : "disabled")."' id_f='".$row['MaDonHang']."'>Duyệt đơn</button>
                    <button class='button-in active' id_i='".$row['MaDonHang']."'>In hóa đơn</button>
                </td>
                </tr>";
            }
        }
        else $data.="<tr><td>Không có đơn hàng nào phù hợp</td></tr>";
        $data.="</tbody>
        </table> </div>";
        echo $data;
    }
    else {
        $chon=$_GET['chon'];
        
        if($chon=="xem"){
            $id=$_GET['id'];
            $strSQL="SELECT * 
            FROM chitietdonhang
            LEFT JOIN sanpham ON chitietdonhang.MaSP = sanpham.MaSP
            WHERE chitietdonhang.MaDonHang =".$id.";
            ";
            $result=$conn->excuteSQL($strSQL);
            $data="
            <div class='table-content'><ol class='breadcrumb'>
            <li class='breadcrumb-item'>Đơn hàng</a></li>
            <li class='breadcrumb-item active'aria-current='page'>Chi tiết đơn hàng</li>
            </ol></nav><table class='table table-striped '>
            <thead><tr>
                <th>Mã sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Số lượng</th>
                <th>Giá sản phẩm</th>
                <th>Thành tiền</th>
            </tr>
            </thead>
            <tbody>";
            $tongtien=0;
            if(mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_array($result)){
                    $thanhtien=$row['GiaCa']*$row['SoLuong'];
                    $tongtien+=$thanhtien;
                    $data.="<tr>
                    <td>".$row['MaSP']."</td>
                    <td>".$row['TenSP']."</td>
                    <td><img src='./img/".$row['HinhAnh']."' class='img-sanpham'></td>
                    <td>".$row['SoLuong']."</td>
                    <td>".formatCurrency($row['GiaCa'])."</td>
                    <td>".formatCurrency($thanhtien)."</td>
                  </tr>";
                }
            }
            $data.="</tbody>
            </table></div>
            <div><h6 class='d-inline'>Tổng tiền: ".formatCurrency($tongtien)."</h6></div>"
            ;
            echo $data;
        }
        else if($chon=="capnhat"){
            //check so luong
            $id=$_GET['id'];
            $strSQL="SELECT * 
            FROM chitietdonhang
            LEFT JOIN sanpham ON chitietdonhang.MaSP = sanpham.MaSP
            WHERE chitietdonhang.MaDonHang ='".$id."'";
            $result=$conn->excuteSQL($strSQL);
            $flag=true;
            if(mysqli_num_rows($result)>0){
                while(mysqli_fetch_assoc($result)){
                    if($row['SoLuong'] > $row['SoLuongSP']){
                        $flag=false;
                        break;
                    }
                }
            }
            if($flag){
                $strSQL="SELECT * 
                FROM chitietdonhang
                LEFT JOIN sanpham ON chitietdonhang.MaSP = sanpham.MaSP
                WHERE chitietdonhang.MaDonHang ='".$id."'";
                $result=$conn->excuteSQL($strSQL);
                if(mysqli_num_rows($result)>0){
                    while($row=mysqli_fetch_assoc($result)){
                        $masp=$row['MaSP'];
                        $soluong=$row['SoLuong'];
                        $soluongSQL=$row['SoLuongSP'];
                        $strSQL="UPDATE `sanpham` SET `SoLuongSP`='".($soluongSQL-$soluong)."' WHERE MaSP='".$masp."'";
                        $conn->excuteSQL($strSQL);
                    }
                    echo 1;
                }
                $strSQL="UPDATE `donhang` SET `TrangThaiDonHang`='1' WHERE MaDonHang='".$id."'";
                $result=$conn->excuteSQL($strSQL);
            }
            else echo 0;
        }
        // else if($chon=="ngay"){
        //     $from=$_GET['from'];
        //     $to=$_GET['to'];
        //     $strSQL="SELECT *
        //     FROM donhang
        //     WHERE NgayDatHang BETWEEN '2023-02-21' AND '2024-05-24';";
        // }
    }
    $conn->disconnect();
?>
