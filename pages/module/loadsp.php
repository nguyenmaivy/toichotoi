<?php
include './controller.php';
$sanpham = new sanpham;
$nhacc =new nhacungcap;
$thuonghieu=new thuonghieu;
$danhmuc=new danhmuc;
if (isset($_REQUEST['maSP'])) {
    $maSP = $_REQUEST['maSP'];
    $result = $sanpham->sanpham($maSP);
    global $string;
    $dsnhacungcap=$nhacc->dsnhacc();
    global $datadsncc;
    global $datathuonghieu;
    global $datadanhmuc;
    $resultth=$thuonghieu->dsthuonghieu();
    while($rowth=mysqli_fetch_array($resultth)){
        $datathuonghieu.='<option value="'.$rowth['MaTH'].'">'.$rowth['TenTH'].'</option>';
    }
    $resultdm=$danhmuc->dsdanhmuc();
    while($rowdm=mysqli_fetch_array($resultdm)){
        $datadanhmuc.='<option value="'.$rowdm['MaDM'].'">'.$rowdm['TenDanhMuc'].'</option>';
    }
    if(mysqli_num_rows($resultth)>0){
        while($row=mysqli_fetch_assoc($dsnhacungcap)){
            $datadsncc.='<option value="'.$row['MaNCC'].'">'.$row['TenNCC'].'</option>';
        }
    }
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
    


        $string .= '<div class="row">
        <div class="col-6">
        <form method="POST" enctype="multipart/form-data" id="formanh">
            <input type="file" name="HinhAnh">
        </form>
        </div>
        <div class="col-6"><form id="form-sua">
        <div class="modal_content-input-box form-group">
                <label for="user1-register">Tên sản phẩm</label>
                <input id="TenSP"
                    name="TenSP" value="'.$row['TenSP'].'">
                <span class="form-message"></span>
            </div>
            <div class="modal_content-input-box form-group">
                <label for="user2-register">Số lượng sản phẩm</label>
                <input type="" id="SoLuongSP" name="SoLuongSP" value="'.$row['SoLuongSP'].'">
                <span class="form-message"></span>
            </div>
            <div class="modal_content-input-box form-group">
                <label for="password-register">Giá sản phẩm</label>
                <input type="" id = "GiaSP" name = "GiaSP" value="'.$row['GiaSP'].'">
                <span class="form-message"></span>
            </div>
            <div class="modal_content-input-box form-group">
                <label for="">Thương hiệu</label>
                <select id="TenTH" name="MaTH">
                    '.$datathuonghieu.'
                </select>
                <span class="form-message"></span>
            </div>
            <div class="modal_content-input-box form-group">
                <label for="">Danh mục</label>
                <select id="TenDM" name="TenDM">
                    '.$datadanhmuc.'
                </select>
                <span class="form-message"></span>
            </div>

            <div class="modal_content-input-box form-group">
                <label for="">Nhà cung cấp</label>
                <select id="TenNCC" name="TenNCC">
                    '.$datadsncc.'
                </select>
            </div>
            
            <div class="modal_content-btn-box">
                <button type="submit" class="btn-login btn-form btn-default" id="btn-register"><span>Xác nhận thay đổi</span></button>
            </div>
        </form></div>
        </div>';
        echo $string;
    }
}

