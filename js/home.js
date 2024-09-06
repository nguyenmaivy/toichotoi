var userlogin;
var Cart=JSON.parse(localStorage.getItem("Cart")) || {};

$('#Login').click(() =>{
    $(".modal-login").css("display","flex")
    $('#Register').addClass('modal_content-header-item-default');
    $('#Login').removeClass('modal_content-header-item-default');
    $('.modal_content-login').css("display","block");
    $(".modal_content-register").css("display","none");
})
$("#Register").click(function(){
    $(".modal-login").css("display","flex")
    $("#Login").addClass("modal_content-header-item-default")
    $('#Register').removeClass('modal_content-header-item-default');
    $(".modal_content-register").css("display","block");
    $('.modal_content-login').css("display","none");
})
$(".btn-close").click(() =>{
    $(".modal-login").css("display","none")
})
//Bỏ thông báo sai đăng nhập
$('input').on("input",() =>{
    $(".error-login").hide()
})
Validator({
    form:'#form-dn',
    rules:[
    Validator.isRequired('#user-login'),
    Validator.isSDT('#user-login'),
    Validator.isRequired('#password-login'),
    Validator.isRequired('#password-login'),
    Validator.isMinLength('#password-login',6),
    ],
    errorElement:'.form-message',
    onSubmit: (value) =>{
        let xhr=new XHR()
        xhr.connect('POST','api/user/auth',value)
        .then((data)=>{
            console.log(data)
            if(data.status){
                $(".modal-login").css("display","flex")
                window.location.href='index.php?chon&id=home';
                sessionStorage.setItem('currentLogin',JSON.stringify(data));
            }
            else {
                $(".error-login").show()
            }  
        })
    }
})
Validator({
    form:'#form-dk',
    rules:[
    Validator.isRequired('#SDT'),
    Validator.isSDT('#SDT'),
    Validator.isRequired('#MatKhau'),
    Validator.isMinLength('#MatKhau',6),
    Validator.isConfirmed('#confirm_password',function(){
        return $('#MatKhau').val();
    }),
    Validator.isRequired('#DiaChi'),
    Validator.isRequired('#UserName'),
    Validator.isMaxLength('#UserName',25),
    Validator.isMinLength("#UserName",6),

    ],
    errorElement:'.form-message',
    onSubmit: (value) =>{
        const string_data_user=JSON.stringify(value);
        let xhr=new XHR()
        xhr.connect('POST','api/user/create',value)
        .then((data)=>{
            if(data.status){
                $(".modal-login").css("display","none")
                alert("Tạo tài khoản thành công, vui lòng đăng nhập để tiếp tục.");
                $("#form-dk").reset()
            }
            else {
                $(".error-login").show()
            }  
        });
    }
})
//Xử lý giao diện đăng nhập
async function CheckLogin() {
    let xhr=new XHR()
    const data = await xhr.connect('POST','api/user/check' , {});
    if(data?.status){
        $(".name_login").text(data.UserName)
        $(".user-dn").addClass("status")
        $(".name_login").removeClass("js_namelogin")
        LoginOption(data.TenNhomQuyen)
        $(".user-logout").click(function(){
            let xhr=new XHR()
            const data = xhr.connect('POST','api/user/logout', {});
        })
    }
    else{
        $(".name_login").text("Đăng nhập")
        $(".user-dn").removeClass("status")
        $(".name_login").addClass("js_namelogin")
        $(".js_namelogin").click(function(){
            $(".modal-login").css("display", "flex");
        })
    }
}
CheckLogin()
//Xử lý logout

function AddCart(id,soluong=1){
    soluong=Number($(".input-qty").val()) || 1;
    if(userlogin?.flag){
        var xhr=new XMLHttpRequest;
        xhr.open("GET","./pages/module/sanpham.php?get&id="+id)
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send();
        xhr.onload=function(){
            alert('Thêm vào giỏ hàng thành công')
            var sanpham=JSON.parse(xhr.responseText)
            var isSanPham
            if(!Cart['arr']){
                Cart['arr']=[]
            }
            isSanPham=Cart['arr'].some(value => value['MaSP'] ==sanpham['MaSP'])
            if(isSanPham){
                Cart['arr'].forEach((value,index) =>{
                    if(value['MaSP']==sanpham['MaSP']){
                        value['soluong']=soluong+value['soluong']
                    }
                })
            }
            else {
                sanpham['soluong']=soluong;
                Cart['arr'].push(sanpham)
            }
            sanpham=null
            localStorage.setItem("Cart",JSON.stringify(Cart))
            if(Cart['arr']){
                console.log(Cart['arr'].length)
                $(".js_numcart").text(Cart['arr'].length)
            }
        }
    }
    else 
        alert("Phải đăng nhập mới có thể mua hàng")
}
function LoginOption(level){
    var html=`<li><a class="option-item">
    <i class="fa fa-user" aria-hidden="true"></i> Trang cá nhân</a></li>
    <li>
    `
    if(level=="Admin"){
        html+=`<a class="option-item" href='admin.html'><i class="fa fa-book" aria-hidden="true"></i>Trang phân quyền</a></li>`
        html+=`<a class="option-item" href='admin1.php'><i class="fa fa-book" aria-hidden="true"></i>Vào trang Admin</a></li>`
    }
    else if(level=="KH"){
        html+=`<a class="option-item"><i class="fa fa-book" aria-hidden="true"></i>Xem lại đơn hàng</a></li>`
    }
    else {
        html+=`<a class="option-item" href='admin1.php'><i class="fa fa-book" aria-hidden="true"></i>Vào trang Admin</a></li>`
    }
    html+=`<li><a class="user-logout option-item" href="index.php?chon&id=home"><i class="fa fa-sign-out" aria-hidden="true"></i> Thoát</a></li>`
    $(".option-dn").html(html)
}
function TangNe(index){
    var oldValue=Number($(".js_soluong"+index).val())
    console.log(oldValue)
    $(".js_soluong"+index).val(oldValue+1)
    Cart['arr'].forEach((value) => {
        if(value['MaSP']==index){
            tongHoaDon+=Number(value['GiaSP'])
            value['soluong']=oldValue+1
        }
    })
    // $(".js_tongtien").text(tongHoaDon)
    localStorage.setItem("Cart",JSON.stringify(Cart))
    RenderGioHang()

}
function GiamNe(index){
    var oldValue=Number($(".js_soluong"+index).val())
    $(".js_soluong"+index).val(oldValue-1)
    Cart['arr'].forEach((value) => {
        if(value['MaSP']==index){
            tongHoaDon-=Number(value['GiaSP'])
            value['soluong']=oldValue-1
        }
    })
    // $(".js_tongtien").text(tongHoaDon)
    localStorage.setItem("Cart",JSON.stringify(Cart))
    RenderGioHang()
}