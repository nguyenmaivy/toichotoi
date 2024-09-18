var dataAccount=[]
function GetValue(){
    var xhr=new XHR()
    return xhr.connect(undefined,"./pages/module/taikhoan.php?get")
}
function SetValue(value){
    var xhr=new XHR()
    return xhr.connect("POST","./pages/module/taikhoan.php?update",value)
}
function RenderTableAccount(data=false){
    var html=''
    if(!data){
        GetValue()
        .then((data)=>{
            console.log(data)
            dataAccount=JSON.parse(data);
            dataAccount.forEach(value => {
                html+=` <tr style="color: #222222; font-weight: bold;">
                <th scope="row">${value['UserName']}</th>
                <td>${value['SDT']}</td>
                <td>${value['TenNhomQuyen']}</td>
                <td>******</td>
                <td>
                    <button class="btn-info mx-1" onclick="SuaTaiKhoan('${value['SDT']}')">Sửa</button>
                    <button class="btn-danger" onclick="XoaTaiKhoan('${value['SDT']}',event)">Xóa </button>
                </td>
            </tr>';`
            });
            // console.log(data)
            $(".js_table_qltaikhoan").html(html)
        })
    }
    else {
        data.forEach(value => {
            html+=` <tr style="color: #222222; font-weight: bold;">
            <th scope="row">${value['UserName']}</th>
            <td>${value['SDT']}</td>
            <td>${value['TenNhomQuyen']}</td>
            <td>******</td>
            <td>
                <button class="btn-info mx-1" onclick="SuaTaiKhoan('${value['SDT']}')">Sửa</button>
                <button class="btn-danger" onclick="XoaTaiKhoan('${value['SDT']}',event)">Xóa </button>
            </td>
        </tr>';`
        });
        // console.log(data)
        $(".js_table_qltaikhoan").html(html)
    }
}
function CloseModal(){
    $(".container_modal").on("click",function(e){
        if($(e.target).hasClass("container_modal"))
        $(this).removeClass("active")
    })
    $(".icon-close").on("click",function(){
        $(this).parent().parent().removeClass("active")
    })
}
function DataForm(data){
    $("#SDT").val(data['SDT'])
    $("#MatKhau").val(data['MatKhau'])
    $("#UserName").val(data['UserName'])
    $("#DiaChi").val(data['DiaChi'])
}
function SuaTaiKhoan(sdt){
    var dataTK
    dataAccount.forEach(data => {
        if(data['SDT']==sdt){
            return dataTK=data
        }
    });
    $(".container_modal").load("./pages/admin/suatk.php",function(){
        $(this).addClass("active")
        CloseModal()
        DataForm(dataTK)
        SubmitFormSua(sdt)
    })
}
function ThemTaiKhoan(){
    $(".container_modal").load("./pages/admin/themtk.php",function(){
        $(this).addClass("active")
        CloseModal()
        SubmitFormThem()
    })
}
function SubmitFormThem(){
    Validator({
        form: "#form-themtk",
        rules: [
            Validator.isRequired("#SDT"),
            Validator.isSDT("#SDT"),
            Validator.isRequired("#MatKhau"),
            Validator.isConfirmed("#PasswordConfirm",function(){
                return $("#MatKhau").val()
            }),
            Validator.isMinLength("#MatKhau",6),
            Validator.isRequired("#UserName"),
            Validator.isRequired("#DiaChi"),
        ],
        errorElement: '.form-message',
        onSubmit: function(value){
            console.log(value)
            var xhr=new XHR()
            return xhr.connect("POST","./pages/module/taikhoan.php?them",value)
            .then(function(data){
                console.log(data)
                if(data=='success'){
                    alert("Thêm tài khoản thành công")
                    $(".icon-close").click()
                    RenderTableAccount()
                }
                else {
                    $(".error-login").css("display","block")
                    $("input").on("input",function(){
                        $(".error-login").css("display","none")
                    })
                }
            })
        }
    }
    )
}
function SubmitFormSua(sdt){
    Validator({
        form: "#form-suatk",
        rules: [
            Validator.isRequired("#SDT"),
            Validator.isSDT("#SDT"),
            Validator.isRequired("#MatKhau"),
            Validator.isMinLength("#MatKhau",6),
            Validator.isRequired("#UserName"),
            Validator.isRequired("#DiaChi"),
        ],
        errorElement: '.form-message',
        onSubmit: function(value){
            value['SDT']=sdt
            console.log(value)
            var xhr=new XHR()
            return xhr.connect("POST","./pages/module/taikhoan.php?update",value)
            .then(function(){
                alert("Sửa thông tin tài khoản thành công")
                RenderTableAccount()
                $(".icon-close").click()
            })
        }
    }
    )
}
function XoaTaiKhoan(sdt,e){
    var choice=confirm("Bạn có chắc muốn xóa tài khoản này không")
    if(choice){
        var xhr=new XHR()
        $(e.target).parent().parent().remove()
        return xhr.connect("GET","./pages/module/taikhoan.php?delete&SDT="+sdt)
            .then(function(){
                alert("Xóa tài khoản thành công")
            })
    }
}
//Tìm tài khoản
function SearchTaiKhoan(e){
    var regex=new RegExp($(e.target).val())
    var array=dataAccount.filter((value)=>(regex.test(value.SDT)))
    RenderTableAccount(array)
}