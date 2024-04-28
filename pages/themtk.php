<div class="model-them p-2">
    <form id="form-them">
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
                <input type="password" placeholder="Nhập lại mật khẩu" id="confirm_password">
                <span class="form-message"></span>
            </div>
            <div class="modal_content-input-box form-group">
                <label for="username-register">Tên đăng ký</label>
                <input type="text" placeholder="Nhập tên đăng ký" id="username-register" name="username_register">
                <span class="form-message"></span>
            </div>
            <span class="error-login mb-2">Tài khoản tồn tại</span>
            <div class="modal_content-btn-box">
                <button type="submit" class="btn-login btn-form btn-default" id="btn-register"><span>Thêm tài khoản</span></button>
                <button type="reset" class="btn-form btn-closee">Làm mới</button>
                <!-- <span><a href="index.php?chon=home"></a></span> -->
            </div>
    </form>
</div>
<script>
    $(".btn-closee").click(function(){
        $(".btn-login").addClass("btn-default")
    })
    $("input").on("input",function(){
        $(".error-login").css("display","none")
    })
    Validator({
        form: "#form-them",
        rules: [
            Validator.isRequired("#user1-register"),
            Validator.isSDT("#user1-register"),

            Validator.isRequired("#password-register"),
            
            Validator.isRequired("#confirm_password"),
            Validator.isConfirmed("#confirm_password",function(){
                return $('#password-register').val();
            }),

            Validator.isRequired("#username-register"),
            Validator.isMinLength("#username-register",6),
            Validator.isMaxLength("#username-register",25),
        ],
        errorElement: ".form-message",
        onSubmit: function(value){
            console.log("cmmmm");
            var data=JSON.stringify(value);
            var xhr=new XMLHttpRequest();
            xhr.open("POST","./pages/module/taikhoan.php?them");
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send("dataJSON="+data);
            xhr.onload=function(){
                if(xhr.status>=200 && xhr.status<300){
                    console.log(xhr.responseText);
                    if(xhr.responseText==1){
                        alert("Tạo tài khoản thành công")
                        $(".model-content").load("./pages/themtk.php")
                    }
                    else if(xhr.responseText==2){
                        $(".error-login").css("display","flex")
                    }
                    else {
                        echo 
                        alert("Tạo tài khoản thất bại")
                    }
                }
            }
        }
    })
</script>