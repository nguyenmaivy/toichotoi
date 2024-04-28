<?php 
    //Thư viện number-to-words
    require '../.././lib/vendor/autoload.php';
    require './controller.php';
    use PHPViet\NumberToWords\Transformer;
    $transformer = new Transformer();
    $banhang=new banhang;
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
    $id=0;
    $strSQL='';
    if(isset($_GET['id'])){
        $id=$_GET['id'];
        $result=$banhang->timdonhang($id);
        $row=mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result)>0){
            $arr=explode('-',$row['NgayDatHang']);
            $data="
            <div class='btn-loaddon'>Đơn hàng > Hóa đơn</div> 
            <button class='float-right print-pdf'>Xem PDF</button>
                    <div class='wrapper-hoadon'>
                        <h2 class='text-cent'>HÓA ĐƠN BÁN HÀNG</h2>
                        <p class='text-cent'>Ngày ".$arr[2]." tháng ".$arr[1]." năm ".$arr[0]."</p>
                        <span>Đơn vị bán hàng: </span><h5 class='d-inline'> Cửa hàng mỹ phẩm Belleza</h5><br>
                        <span >Mã số thuế:<h6 class='d-inline'> 0123456789</h6></span>
                        <p>Địa chỉ: 99 An Dương Vương, P16, Q8, TPHCM</p>
                        <div class='horizontal-line'></div>

                        <span>Tên người mua hàng: <h6 class='d-inline'>Huỳnh Văn Phú</h6></span><br>
                        <span>Địa chỉ: <h6 class='d-inline'>Thôn Tiên Sơn 2, Xã Tân Sơn, Quận 8, Hồ Chí Minh</h6> </span><br>
                        <span>Hình thức thanh toán:.......................</span><br>
                        <table class='table table-bordered mt-2' style='border: 2px solid black'>
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                            </tr>
                            </thead>
                    <tbody><tr>
                            <td style='padding:0 8px'>1</td>
                            <td style='padding:0 8px'>2</td>
                            <td style='padding:0 8px'>3</td>
                            <td style='padding:0 8px'>4</td>
                            <td style='padding:0 8px'>5=3x4</td>
                        </tr>";
            $stt=2;
            $tongtien=0;
            $result->data_seek(0);
            while($row=mysqli_fetch_assoc($result)){
                $thanhtien=$row['GiaCa']*$row['SoLuong'];
                $tongtien+=$thanhtien;
                $data.="<tr>
                <td>".$stt."</td>
                <td>".$row['TenSP']."</td>
                <td>".$row['SoLuong']."</td>
                <td>".formatCurrency($row['GiaCa'])."</td>
                <td>".formatCurrency($thanhtien)."</td>
                </tr>";
                $stt++;
            }
            $data.="<tr><td colspan='5'>Tổng hiền hàng hóa: <h6 class='d-inline'>".formatCurrency($tongtien)."</h6> </td>
            </tr></tbody>
            </table>
            <span>Số tiền viết bằng chữ:<h6 class='d-inline text-capitalize'> ".$transformer->toCurrency($tongtien)."</h6></span>
            <div class='d-flex justify-content-around mt-3 mb-5'>
                <div> <h6 class='d-inline'>Người mua hàng </h6>
                    <p class='py-2 mb-5'>(Ký, ghi rõ họ tên)</p>
                </div>
                <div><h6 class='d-inline'>Người bán hàng</h6>
                    <p class='py-2 mb-5'>(Ký, ghi rõ họ tên)</p>
                </div>
            </div>
            <footer style='text-align: center;font-size:12px;'>
            <spand>In tại cửa hàng kinh doanh mỹ phẩm Belleza Hotline: 0369698361</spand>
                
            </footer>
        </div>";
            

            echo $data;
        }
        else {
            echo 0;
        }
    }

?>
