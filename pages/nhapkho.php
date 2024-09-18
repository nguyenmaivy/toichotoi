<div class="item-nhapkho-menu p-2">
    <i class="ti-angle-double-down float-end btn-show"></i>
    
    
</div>
<div class="d-flex flex-column">
    <div class="item-nhapkho pannel">
        <!-- cmmmmm -->
        <span class="text-primary d-inline" style="position:relative;top:30px;left:250px">Chọn sản phẩm để thêm</span>
        <div class="row">
            <div class="col-12 table-content-nhap">
                <table class="table table-hover w-100" id="table_nhapkho-sanpham">
                    <thead>
                        <tr>
                            <th style="width:15%">Mã sản phẩm</th>
                            <th >Tên sản phẩm</th>
                            <th style="width:15%">Thương hiệu</th>
                            <th style="width:15%">Tồn kho</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            include './module/controller.php';
                            $sanpham=new sanpham;
                            $result=$sanpham->danhsachsp();
                            if(mysqli_num_rows($result)>0){
                                $data="";
                                while($row=mysqli_fetch_assoc($result)){
                                    $data.='<tr onclick="setValueForm(event)" data-masp="'.$row['MaSP'].'">
                                    <td>'.$row['MaSP'].'</td>
                                    <td>'.$row['TenSP'].'</td>
                                    <td>'.$row['TenTH'].'</td>
                                    <td>'.$row['SoLuongSP'].'</td></tr>';
                                }
                                echo $data;
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-4">
                <form action="" id="form-phieunhap">
                    
                    
                </form>
            </div>
        </div>
    </div>
    <div class="item-nhapkho">
    <h4 class="text-cent">Thông tin phiếu nhập</h4>
    <h6 class="text-cent ngaynhap"><?php echo "Ngày " . date("d") . " tháng " . date("m") . " năm " . date("Y");?></h6>
    <div class="m-4 fw-bold">
        <label for="">Chọn nhà cung cấp:</label>
        <select name="" id="form_phieunhap-nhacc" class="w-25">
        <?php 
            $nhacungcap=new nhacungcap;
            $result=$nhacungcap->dsnhacc();
            if(mysqli_num_rows($result)>0){
                $data="";
                while($row=mysqli_fetch_assoc($result)){
                    $data.='<option value="'.$row['MaNCC'].'">'.$row['TenNCC'].'</option>';
                }
                echo $data;
            }
        ?>
    </select></div>
        <table class="table table-bordered" id="table_phieunhap">
            <thead>
                <tr>
                    <th scope="col">Mã sản phẩm</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Đơn giá</th>
                    <th scope="col">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <div>Tổng tiền: <h6 class="tongtien-phieunhap d-inline">0</h6></div> 
        <button class="them-phieunhap btn btn-info">Thêm sản phẩm</button>
        <button class="luu-phieunhap btn btn-info" onclick="handleLuuPhieu('luu')" >Lưu phiếu nhập</button>
        <button class="luuin-phieunhap btn btn-info"onclick="handleLuuPhieu('luuin')" >Lưu và in phiếu nhập</button>
    </div>
</div>
