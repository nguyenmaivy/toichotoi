<div class="model-sua p-2">
<form id="form-sua">
    <div class="modal_content-input-box form-group">
            <label for="user1-register">Số điện thoại</label>
            <input placeholder="Nhập số điện thoại" id="user1-register" disabled
                class="hide-number-spinner" name="user1_register">
            <span class="form-message"></span>
        </div>
        <!-- <div class="modal_content-input-box form-group">
            <label for="user2-register">Email</label>
            <input type="text" placeholder="Nhập email" id="user2-register" name="user2-register">
            <span class="form-message"></span>
        </div> -->
        <div class="modal_content-input-box form-group">
            <label for="password-register">Mật khẩu</label>
            <input type="" placeholder="Nhập mật khẩu" id="password-register" name="password_register">
            <span class="form-message"></span>
        </div>
        <div class="modal_content-input-box form-group">
            <label for="username-register">Tên đăng ký</label>
            <input type="text" placeholder="Nhập tên đăng ký" id="username-register" name="username_register">
            <span class="form-message"></span>
        </div>
        <div class="modal_content-input-box form-group">
            <label for="">Trạng thái tài khoản </label>
            <select id="status_account" name="status_account">
                <option value="hide">Khóa</option>
                <option value="show" selected >Bình thường</option>
            </select>
        </div>
        <div class="modal_content-btn-box">
            <button type="submit" class="btn-login btn-form btn-default" id="btn-register"><span>Xác nhận thay đổi</span></button>
            <button type="reset" class="btn-form btn-closee">Làm mới</button>
            <span class="error-login">Tài khoản đã tồn tại</span>
            <!-- <span><a href="index.php?chon=home"></a></span> -->
        </div>
</form>
</div>
<script src="./js/suatk.js"></script>