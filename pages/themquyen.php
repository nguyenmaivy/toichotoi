<div class="model-sua p-2">
<form id="form_quyen">
    <div class="modal_content-input-box form-group">
            <label for="user1-register">Số điện thoại</label>
            <input placeholder="Nhập số điện thoại" id="user1-register" disabled
                class="hide-number-spinner" name="user1_register">
            <span class="form-message"></span>
        </div>
        <div class="modal_content-input-box form-group">
            <label for="username-register" >Tên đăng ký</label>
            <input type="text" placeholder="Nhập tên đăng ký" id="username-register" name="username_register" disabled>
            <span class="form-message"></span>
        </div>
        <div class="modal_content-input-box form-group">
            <label for="quyen">Gán quyền cho tài khoản</label>
            <!-- <input type="text" placeholder="Nhập tên đăng ký" id="username-register" name="username_register"> -->
            <!-- <span class="form-message"></span> -->
            <select name="quyen" id="quyen">
                <option value="KH">Khách hàng</option>
                <option value="QLBH">Nhân viên bán hàng</option>
                <option value="QLK">Nhân viên quản lý kho</option>
                <option value="Admin">Admin</option>
            </select>
        </div>
        <div class="modal_content-btn-box">
            <button type="submit" class="btn-login btn-form btn-default" id="btn-register"><span>Xác nhận thay đổi</span></button>
        </div>
</form>
</div>