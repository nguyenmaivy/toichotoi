<div class="model-them p-2">
    <form id="form-them">
    <div class="row">
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
                    <option value="">Thương hiệu</option>
                    '.$datathuonghieu.'
                </select>
                <span class="form-message"></span>
            </div>
            <div class="modal_content-input-box form-group">
                <label for="">Danh mục</label>
                <select id="TenDM" name="TenDM">
                    <option value="">Thương hiệu</option>
                    '.$datadanhmuc.'
                </select>
                <span class="form-message"></span>
            </div>

            <div class="modal_content-input-box form-group">
                <label for="">Nhà cung cấp</label>
                <select id="TenNCC" name="TenNCC">
                    <option value="">Thương hiệu</option>
                    '.$datadsncc.'
                </select>
            </div>
            
            <div class="modal_content-btn-box">
                <button type="submit" class="btn-login btn-form btn-default" id="btn-register"><span>Xác nhận thêm sản phẩm</span></button>
            </div>
        </form></div>
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
            Validator.isRequired("#user1-register"),
            Validator.isSDT("#user1-register"),

            Validator.isRequired("#password-register"),

            Validator.isRequired("#confirm_password"),
            Validator.isConfirmed("#confirm_password", function() {
                return $('#password-register').val();
            }),

            Validator.isRequired("#username-register"),
            Validator.isMinLength("#username-register", 6),
            Validator.isMaxLength("#username-register", 25),
        ],
        errorElement: ".form-message",
        onSubmit: function(value) {
            console.log("cmmmm");
            var data = JSON.stringify(value);
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "./pages/module/taikhoan.php?them");
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send("dataJSON=" + data);
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    console.log(xhr.responseText);
                    if (xhr.responseText == 1) {
                        alert("Tạo tài khoản thành công")
                        $(".model-content").load("./pages/themtk.php")
                    } else if (xhr.responseText == 2) {
                        $(".error-login").css("display", "flex")
                    } else {
                        echo
                        alert("Tạo tài khoản thất bại")
                    }
                }
            }
        }
    })
</script>