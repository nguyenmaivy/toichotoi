<?php include './controller.php';
$nhacc = new nhacungcap;
if(isset($_REQUEST['MaNCC'])){
    $mancc = $_REQUEST['MaNCC'];
    $result = $nhacc->nhaCC($mancc);
    global $string;
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $string .='<div class="row">
        <div class="col-6"><form id="form-sua">
        <div class="modal_content-input-box form-group">
                <label for="user1-register">Tên nhà cung cấp</label>
                <input id="TenNCC"
                    name="TenNCC" value="'.$row['TenNCC'].'">
                <span class="form-message"></span>
            </div>
            <div class="modal_content-input-box form-group">
                <label for="user2-register">Địa chỉ nhà cung cấp</label>
                <input type="" id="DiaChi" name="DiaChi" value="'.$row['DiaChi'].'">
                <span class="form-message"></span>
            </div>
            <div class="modal_content-input-box form-group">
                <label for="password-register">Email</label>
                <input type="" id = "Email" name = "Email" value="'.$row['Email'].'">
                <span class="form-message"></span>
            </div>
            <div class="modal_content-input-box form-group">
                <label for="">Số điện thoại</label>
               
                <input type="" id="SoDienThoai" name="SoDienThoai" value="'.$row['SoDienThoai'].'">
                
                <span class="form-message"></span>
            </div>
            <div class="modal_content-btn-box">
                <button type="submit" class="btn-login btn-form btn-default" id="btn-register"><span>Xác nhận thay đổi</span></button>
            </div>
        </form></div>
        </div>';
        echo $string;
    }
}