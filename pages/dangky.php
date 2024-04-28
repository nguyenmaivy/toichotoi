<div class="modal-login">
        <div class="modal_content">
            <ul class="modal_content-header">
                <li class="modal_content-header-item" id="Login">
                    <span>Đăng nhập</span>
                    <div class="modal_content-header-item-line"></div>
                </li>
                <li class="modal_content-header-item modal_content-header-item-default" id="Register">
                    <span>Đăng ký</span>
                    <div class="modal_content-header-item-line"></div>
                </li>
            </ul>
            <!-- LOGIN -->
            <form action="" autocomplete="off" id="form-1">
                <div class="modal_content-login">
                    <div class="modal_content-input-box form-group">
                        <label for="user-login">Số điện thoại</label>
                        <input type="text" placeholder="Nhập số điện thoại" id="user-login" name="user_login">
                        <span class="form-message"></span>
                    </div>
                    <div class="modal_content-input-box form-group">
                        <label for="password-login">Mật khẩu</label>
                        <input type="password" placeholder="Nhập mật khẩu" id="password-login" name="password_login">
                        <span class="form-message"></span>
                    </div>
                    <div class="modal_content-btn-box">
                        <button class="btn-form btn-login btn-default" id="btn-login"><span>Đăng nhập</span></button>
                        <button type="reset" class="btn-form btn-close"><span>Bỏ qua</span></button>
                        <span class="error-login">Số điện thoại hoặc Mật khẩu sai!</span>
                        <!-- <a href="index.php?chon=home"></a> -->
                    </div>
                </div>
            </form>
            <!-- REGISTER -->
            <form action="" onsubmit="return checkForm()" autocomplete="off" id="form-2">
                <div class="modal_content-register">
                    <div class="modal_content-input-box form-group">
                        <label for="user1-register">Số điện thoại</label>
                        <input placeholder="Nhập số điện thoại" id="user1-register"
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
                        <input type="password" placeholder="Nhập mật khẩu" id="password-register" name="password_register">
                        <span class="form-message"></span>
                    </div>
                    <div class="modal_content-input-box form-group">
                        <label for="confirm-password">Nhập lại mật khẩu</label>
                        <input type="password" placeholder="Nhập mật khẩu" id="confirm_password">
                        <span class="form-message"></span>
                    </div>
                    <div class="modal_content-input-box form-group">
                        <label for="username-register">Tên đăng ký</label>
                        <input type="text" placeholder="Nhập tên đăng ký" id="username-register" name="username_register">
                        <span class="form-message"></span>
                    </div>
                      <div class="modal_content-btn-box">
                          <button type="submit" class="btn-login btn-form btn-default" id="btn-register"><span>Đăng ký</span></button>
                          <button type="reset" class="btn-form btn-close">Bỏ qua</button>
                          <span class="error-login">Tài khoản đã tồn tại</span>
                          <!-- <span><a href="index.php?chon=home"></a></span> -->
                      </div>
                      <div class="modal_content-register-rule">
                          <p>
                             Bằng việc đăng ký, bạn đã đồng ý với Cửa hàng về
                             <span>Điều khoản dịch vụ</span> &  
                             <span>Chính sách bảo mật</span>
                          </p>
                      </div>
                        <div class="div-error-regisrer"><span class="error-register"></span></div>    
                   </div>
            </form>
        </div>
</div>
<div id="toast">
</div>

<!-- <div class="containerr start-0"></div> -->
<script src="js/vadidation.js"></script>
<script>

</script>
