<div class="model-timtk p-2">
    <form id="form-tim">
        <div class="modal_content-input-box form-group">
                <label for="user1-register">Số điện thoại</label>
                <input placeholder="Nhập số điện thoại" id="user1-register"
                    class="hide-number-spinner" name="user1_register">
                <span class="form-message"></span>
        </div>
        <span class="error-login mb-2">Tài khoản không tồn tại</span>
        <div class="modal_content-btn-box">
            <button type="submit" class="btn-login btn-form btn-default" id="btn-register"><span>Tìm kiếm</span></button>
            <button type="reset" class="btn-form btn-closee">Làm mới</button>
            <!-- <span><a href="index.php?chon=home"></a></span> -->
        </div>
    </form>
</div>
<script>
    window.ttTK={};
    $("#user1-register").on("input",function(){
        $(".error-login").css("display","none");
    })
    $(".btn-closee").click(function(){
        $(".btn-login").addClass("btn-default")
    })
    Validator({
        form: "#form-tim",
        rules: [
            Validator.isRequired("#user1-register"),
            Validator.isSDT("#user1-register"),
        ],
        errorElement: ".form-message",
        onSubmit: (value) =>{
            //Trả dữ liệu về sever
            var xhr = new XMLHttpRequest();
            var status=<?php echo $_GET['status'];?>;
            xhr.open('GET', "pages/module/taikhoan.php?tim&user1_register=" + value.user1_register+"&status="+status);
            xhr.send();
            xhr.onload = function loadData() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    if(xhr.responseText){
                        ttTK=JSON.parse(xhr.responseText)
                        console.log(ttTK)
                        if(ttTK.status==1){
                            $(".model-content").load("./pages/suatk.php")
                        }
                        else if(ttTK.status==2){
                            var flag=confirm("Bạn có chắc muốn xóa tài khoản này?");
                            if(flag){
                                xhr = new XMLHttpRequest();
                                xhr.open('GET', "./pages/module/taikhoan.php?user1_register=" + ttTK.SDT);
                                xhr.send();
                                xhr.onload=function(){
                                    if(xhr.status >=200 && xhr.status<300){
                                        if(xhr.responseText==1){
                                            alert("Tài khoản đã xóa thành công")
                                        }
                                        else alert("Tài khoản xóa thất bại")
                                    }else {
                                        alert("Tài khoản xóa thất bại")
                                    }
                                }
                            }
                        }
                    }
                    else {
                        $(".error-login").css("display","flex")

                    }
                }
            };
        }
    })
</script>