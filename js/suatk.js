var inputE=document.querySelector('form').querySelectorAll("[name]")
    var tmp={
        user1_register:ttTK.SDT,
        password_register:ttTK.MatKhau,
        username_register:ttTK.UserName,
        status_account:ttTK.TrangThai
    }
    Array.from(inputE).forEach((input)=>{
            input.value=tmp[input.name]; 
    })
    $(".btn-login").removeClass("btn-default")

    Validator({
        form: "#form-sua",
        rules: [
            Validator.isRequired("#user1-register"),
            Validator.isSDT("#user1-register"),

            Validator.isRequired("#password-register"),
            Validator.isMaxLength("#password-register",20),

            Validator.isRequired("#username-register"),
            Validator.isMaxLength("#username-register",15),
        ],
        errorElement: ".form-message",
        onSubmit: function(value){
            console.log(value)
            var xhr=new XMLHttpRequest();
            var data=JSON.stringify(value)
            xhr.open("POST","./pages/module/taikhoan.php?sua");
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send("dataJSON="+data);
            xhr.onload=function(){
                if(xhr.status>=200 && xhr.status<300){
                    if(xhr.responseText=="1"){
                        alert("Cập nhật khoản thành công");
                    }
                    else alert("Cập nhật tài khoản thất bại")
                }
                else alert("Cập nhật tài khoản thất bại")
            }
            $(".model-content").load("./pages/timtk.php?status=1")
        }
    })