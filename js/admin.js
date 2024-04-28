$(".root").load("pages/admin.php",function(){
    $(".button-model").click(function(e){
        $(".button-model.active").removeClass("active")
        $(this).addClass("active")
        $(".content-left").toggle("active")
        Validator({
            form: "#form-tim",
            rules: [
                Validator.isRequired("#user1-register"),
                Validator.isSDT("#user1-register"),
            ],
            errorElement:".form-message",
            onSubmit: function(value){
                var xhr=new XMLHttpRequest();
                xhr.open("GET","./pages/module/taikhoan.php?tim&user1_register="+value.user1_register+"&status=1");
                xhr.send();
                xhr.onload=function(){
                    if(xhr.status>=200 && xhr.status<300){  
                        var data=JSON.parse(xhr.responseText);
                        if(data){
                            $(".item-left").load("./pages/themquyen.php",function(){
                                var inputE=document.querySelector('form').querySelectorAll("[name]")
                                var formE=document.querySelector("#form_quyen")
                                console.log(formE)
                                var tmp={
                                    user1_register:data.SDT,
                                    username_register:data.UserName,
                                    quyen:data.TenNhomQuyen
                                }
                                Array.from(inputE).forEach((input)=>{
                                        input.value=tmp[input.name]; 
                                })
                                $(".btn-login").removeClass("btn-default")
                                formE.onsubmit=function(e){
                                    e.preventDefault()
                                    var data={}
                                    const quyenE=$("#quyen").val();
                                    Array.from(inputE).forEach((input)=>{
                                        data[input.name]=input.value
                                    })
                                    var xhr=new XMLHttpRequest();
                                    xhr.open("POST","./pages/module/taikhoan.php?suaquyen");
                                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                    xhr.send("data="+JSON.stringify(data));
                                    xhr.onload=function(){
                                        if(xhr.status>=200 &&xhr.status<300){
                                            if(xhr.responseText==1){
                                                alert("Thay đổi thành công")
                                                location.reload(false)
                                            }
                                        }
                                    }

                                }
                            })
                        }
                    }
                }
            }
        })  
    })
});