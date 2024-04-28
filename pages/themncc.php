<div class="model-them p-2">
    <form id="form-them">
        <div class="modal_content-input-box form-group">
            <label for="user1-register">Tên nhà cung cấp</label>
            <input id="TenNCC" name="TenNCC">
            <span class="form-message"></span>
        </div>
        <div class="modal_content-input-box form-group">
            <label for="password-register">Địa chỉ nhà cung cấp</label>
            <input id="DiaChi" name="DiaChi">
            <span class="form-message"></span>
        </div>
        <div class="modal_content-input-box form-group">
            <label for="confirm-password">Email</label>
            <input id="Email" name="Email">
            <span class="form-message"></span>
        </div>
        <div class="modal_content-input-box form-group">
            <label for="username-register">Số điện thoại</label>
            <input id="SoDienThoai" name="SoDienThoai">
            <span class="form-message"></span>
        </div>
        <span class="error-login mb-2">Nhà cung cấp tồn tại</span>
        <div class="modal_content-btn-box">
            <button type="submit" class="btn-login btn-form btn-default" id="btn-register"><span> Cập nhật thêm nhà cung cấp </span></button>
        </div>
    </form>
</div>
<script>
    $(".btn-closee").click(function() {
        $(".btn-login").addClass("btn-default")
    })
    $("input").on("input", function() {
        $(".error-login").css("display", "none")
    })
    Validator({
        form: "#form-them",
        rules: [
            Validator.isRequired("#TenNCC"),
            // Validator.isSDT("#TenNCC"),

            Validator.isRequired("#DiaChi"),

            Validator.isRequired("#Email"),
            // Validator.isConfirmed("#Email", function() {
            //     return $('#DiaChi').val();
            // }),

            Validator.isRequired("#SoDienThoai"),
            Validator.isMinLength("#SoDienThoai", 6),
            Validator.isMaxLength("#SoDienThoai", 25),
        ],
        errorElement: ".form-message",
        onSubmit: function(value) {
            console.log(value);
            var data = JSON.stringify(value);
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "./pages/module/nhaCC.php?them");
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send("dataJSON=" + data);
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    console.log(xhr.responseText);
                        alert("Tạo nhà cung cấp thành công")
                        $(".model-content").load("./pages/themncc.php")
                }
            }
        }
    })
</script>