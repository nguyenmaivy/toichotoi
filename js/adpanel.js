function cook() {
    window.location = "index.php";
}
//Đọc dự liệu đăng nhập để thêm class disabled 
function init(index) {
    var name = ["", "Quản lý Kho", "Quản lý Bán Hàng"];
    name = [[], ["Quản lý Kho", "Thống kê doanh thu"], ["Quản lý Bán Hàng", "Thống kê doanh thu"]]
    $(".container.disabled").removeClass("disabled");
    $(".container").each(function () {
        name[index].forEach((i) => {
            if ($(this).find(".item-container").text().trim() == i) {
                console.log($(this).find(".item-container").text().trim())
                $(this).find(".item-container").addClass("disabled");
            }
        })
    })
}
init(0);

$("#banhang").click(function () {
    if (!$(this).hasClass("disabled")) {
        $(".menudrop-banhang").toggle("active")
    }
})
$("#qlkho").click(function () {
    if (!$(this).hasClass("disabled")) {
        $(".menudrop-qlkho").toggle("active")
    }
})

//Chức năng quản lý kho
$(".item-menu").click(function (e) {
    var text = $(this).contents().filter(function () {
        return this.nodeType === 3;
    }).text().trim();
    $(".item-menu.active").removeClass("active");
    $(this).addClass("active");
    switch (text) {
        case "Quản lý sản phẩm":
            console.log("cmm")
            qlkho()
            break;
        case "Quản lý nhà cung cấp":
            qlncc()
            break;
        case "Tìm kiếm sản phẩm":
            break;
        case "Lập phiếu nhập kho":
            nhapkho()
            break;
        case "Thống kê lịch sử nhập":
            thongkenhap()
            break;
        case "Quản lý tài khoản":
            qlTaiKhoan()
            break;
        case "Đơn hàng":
            duyetdonhang()
            break;
        case "Xem thống kê bán hàng":
            xemThongKe();
            break;
    }
})
//Xử lý sự kiện bên quản lý bán hàng nè
function qlTaiKhoan() {
    $(".model-right.active").removeClass("active")
    $(".model-tk").addClass("active")
    $(".model-item").click(function (e) {
        $(".model-item.active").removeClass("active")
        if (e.target.innerText == "Thêm tài khoản") {
            $(this).addClass("active")
            $(".model-content").load("./pages/themtk.php")
        }
        else if (e.target.innerText == "Sửa tài khoản") {
            $(this).addClass("active")
            console.log("cmm")
            $(".model-content").load("./pages/timtk.php?status=1")
        }
        else if (e.target.innerText == "Xóa tài khoản") {
            $(this).addClass("active")
            $(".model-content").load("./pages/timtk.php?status=2")
        }
    })
}
function duyetdonhang() {
    $(".model-right.active").removeClass("active")
    $(".model-duyetdon").addClass("active")
    $(".model-item").click(function (e) {

        $(".model-item.active").removeClass("active");
        if (e.target.innerText == "Danh sách đơn hàng") {
            $(this).addClass("active");
            $(".model-content-hd").load("./pages/module/loaddon.php", function () {
                viewDuyet();
            })
        }
        else if (e.target.innerText == "Lọc danh sách đơn hàng chưa duyệt") {
            $(this).addClass("active");
            $(".table-content").load("./pages/module/loaddon.php?status=0", function () {
                viewDuyet();
            })
        }
    })

}
function viewDuyet() {
    $(".button-duyet.active").click(function (e) {
        e.stopPropagation();
        $(this).removeClass("active")
        $(this).addClass("disabled")
        $(this).closest("tr").find(".tittle-status").text("Đã duyệt");
        handleDuyet($(this).attr("id_f"))
    })

    $(".button-in").click(function (e) {
        e.stopPropagation()

        inHoaDon($(this).attr("id_i"));
    })
    $("tr").click(function () {
        $(".table-content").load("./pages/module/loaddon.php?id=" + $(this).attr("id") + "&chon=xem", function () {
            $(".btn-loaddon").click(function () {
                $(".table-content").load("./pages/module/loaddon.php", function () {
                    viewDuyet();
                })
            })
        })
    })
}

function handleDuyet(id) {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "./pages/module/loaddon.php?id=" + id + "&chon=capnhat");
    xhr.send();
    xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 300) {
            console.log(xhr.responseText)
            if (xhr.responseText == 1) {
                alert("Duyệt đơn hàng thành công")
            }
            else alert("Duyệt đơn hàng thất bại")
        }
        else alert("Không thể kết nối với server")
    }
}
function inHoaDon(id) {
    $(".table-content").load("./pages/module/xlinhoadon.php?id=" + id, function () {
        $(".print-pdf").click(function (e) {
            e.stopPropagation();
            window.open("./hoadon.php?id=" + id);
        })
        $(".btn-loaddon").click(function () {
            $(".table-content").load("./pages/module/loaddon.php", function () {
                viewDuyet();
            })
        });
    })
}
function handTimeDon() {
    var from = $("#from-time").val();
    var to = $("#to-time").val();
    if ($(".model-item.active").text().trim() == "Danh sách đơn hàng") {
        $(".model-content-hd").load("./pages/module/loaddon.php?from=" + from + "&to=" + to, function () {
            viewDuyet();
        })
    }
    else {
        $(".model-content-hd").load("./pages/module/loaddon.php?status=0&from=" + from + "&to=" + to, function () {
            viewDuyet();
        })
    }
}
function timdonhang(event){
    
    if(event.key=="Enter"){
        $.post("./pages/module/loaddon.php?timdon",
        {
          SDT: $(".search-donhang").val(),
        },
        function(data,status){
            $(".model-content-hd").html(data)
            viewDuyet()
        });
    }
}
function handTimeTK(){
    var from = $("#from-time-tk").val();
    var to = $("#to-time-tk").val();
        $(".baocao").load("./pages/thongkeban.php?khoang&from="+from+"&to="+to,function(){
        })
}
function xemThongKe() {
    $(".model-right.active").removeClass("active")
    $(".model-thongke").addClass("active")
    $(".model-item").click(function (e) {
        $(".model-item.active").removeClass("active")
        if (e.target.innerText == "Báo cáo hôm nay") {
            var date = new Date();
            var year = date.getFullYear();
            var month = (date.getMonth() + 1).toString().padStart(2, '0');
            var day = date.getDate().toString().padStart(2, '0');
            var formattedDate = year + '-' + month + '-' + day;
            $(this).addClass("active")
            $(".model-content-tkbh").load("./pages/thongkeban.php?day=" + formattedDate)
        }
        else if (e.target.innerText == "Báo cáo theo khoảng thời gian") {
            $(this).addClass("active")
            $(".model-content-tkbh").html(`<label for=form-time-tk'>Từ ngày<input type='date' id='from-time-tk'></label>
            <label for='to-time-tk'>Đến ngày<input type='date' id='to-time-tk'></label>
            <button onclick='handTimeTK()'>Lọc</button><div class="baocao"></div>`)
        }
    })
}
// Xây dựng quản lý kho 
function qlkho() {
    $(".model-right.active").removeClass("active")
    $(".model-qlkho").addClass("active")
    $(".model-qlkho").html(`<div class="top-menu">
    <ul class="list-group list-group-horizontal menu-container">
        <li class="list-group-item model-item">Danh sách sản phẩm</li>
        <li class="list-group-item model-item">Thêm sản phẩm</li>
    </ul>
    </div>
    <div class="model-content-kho">
    </div>`)
    $(".model-item").click(function (e) {
        $(".model-item.active").removeClass("active")
        if (e.target.innerText == "Danh sách sản phẩm") {
            $(this).addClass("active")
            $(".model-content-kho").load("pages/module/danhsachsp.php", function () {
                new DataTable('#dataTable');
                $("#search").keypress(function (e) {
                    e.stopPropagation()
                    if (e.key = "Enter") {
                        xhr = new XMLHttpRequest();
                        xhr.open("POST", "./pages/module/sanpham.php")
                        xhr.setRequestHeader("Content-Type", "application/json");
                        xhr.send("data=" + $(this).val())
                        xhr.onload = function () {
                            if (xhr.status >= 200 && xhr.status < 300) {
                                var data = JSON.parse(xhr.response);
                                console.log(data)
                            }
                        }
                    }

                    //Chỗ này code ajax
                })

            })
        }
        else if (e.target.innerText == "Thêm sản phẩm") {
            $(this).addClass("active")
            $(".model-content-kho").load("./pages/themsp.php")
        }
        // else if(e.target.innerText=="Xóa tài khoản"){
        //     $(this).addClass("active")
        //     $(".model-content").load("./pages/timtk.php?status=2")
        // }
    })
}
function xoasanpham(masp) {
    const flag = confirm("Bạn có chắc muốn xóa sản phẩm này không?")
    if (flag) {
        xhr = new XMLHttpRequest();
        xhr.open("GET", "./pages/module/sanpham.php?xoa=" + masp)
        xhr.send()
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 300) {
                alert("Xóa sản phẩm thành công")
            }
        }
    }
}
function suasanpham(masp) {
    $(".model-content-kho").load("./pages/module/loadsp.php?maSP=" + masp, function () {
        $("#btn-register").removeClass("btn-default")
        Validator({
            form: "#form-sua",
            rules: [
                Validator.isRequired("#TenSP"),
                Validator.isRequired("#SoLuongSP"),
                Validator.isRequired("#GiaSP"),
                Validator.isRequired("#TenTH"),
                Validator.isRequired("#TenDM"),
                Validator.isRequired("#TenNCC"),
                
            ],
            onSubmit: function(value){
                const form=document.querySelector("#formanh");
                //Luồng gửi ảnh
                var formData = new FormData(form);
                
                var xhfile = new XMLHttpRequest();
                xhfile.open("POST", "./pages/module/upload.php");

                xhfile.onreadystatechange = function() {
                    if (xhfile.readyState == XMLHttpRequest.DONE) {
                        var messageDiv = document.getElementById("message");
                        if (xhfile.status == 200) {
                            messageDiv.innerHTML = "Tệp ảnh đã được tải lên thành công.";
                        } else {
                            messageDiv.innerHTML = "Đã xảy ra lỗi khi tải lên tệp ảnh.";
                        }
                    }
                }
                console.log(formData);
                xhfile.send(formData);
                //Luồng gửi form
                xhr=new XMLHttpRequest();
                xhr.open('POST','./pages/module/sanpham.php?suasp');
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                value['MaSP']=masp;
                xhr.send("dataJSON="+JSON.stringify(value))
                xhr.onload=function(){
                    if(xhr.status>=200 && xhr.status<300){
                        console.log(xhr.responseText)
                        if(xhr.responseText>0){
                            alert("Sửa thành công");
                            $(".model-content-kho").load("pages/module/danhsachsp.php")
                    }
                    }
                // console.log(value);
                // alert(value)
                }
            }
        })
    });

}
function nhapkho(){
    $(".model-right.active").removeClass("active")
    $(".model-qlkho").addClass("active")
    $(".model-qlkho").load("./pages/nhapkho.php",function(){
        new DataTable('#table_nhapkho-sanpham');
        $(".them-phieunhap").click(function(){
            $(".item-nhapkho.pannel").slideToggle()
            $("#form-phieunhap").hide()
            Validator({
                form: '#form-phieunhap',
                rules: [
                    Validator.isRequired("#form_phieunhap-MaSP"),
                    Validator.isRequired("#form_phieunhap-TenSP"),
                    Validator.isRequired("#form_phieunhap-soluong"),
                    Validator.isRequired("#form_phieunhap-dongia"),
                    Validator.isNumber("#form_phieunhap-soluong"),
                    Validator.isNumber("#form_phieunhap-dongia"),
                ],
                errorElement: '.form-message',
                onSubmit: function(value){
                    var tableE=document.querySelector("#table_phieunhap")
                    var newRow=tableE.insertRow();
                    var newcell0=newRow.insertCell(0)
                    newcell0.innerHTML=value['f_pn_MaSP'];
                    var newcell1=newRow.insertCell(1)
                    newcell1.innerHTML=value['f_pn_TenSP'];
                    var newcell2=newRow.insertCell(2)
                    newcell2.innerHTML=value['f_pn_soluong'];
                    var newcell3=newRow.insertCell(3)
                    newcell3.innerHTML=value['f_pn_dongia'];
                    var newcell4=newRow.insertCell(4)
                    newcell4.innerHTML=$("#form_phieunhap-nhacc option:selected").text()
                    var newcell5=newRow.insertCell(5)
                    newcell5.innerHTML=Number(value['f_pn_soluong'])*Number(value['f_pn_dongia'])
                    $(".item-nhapkho.pannel").slideToggle("show")
                    $(".table-content-nhap").removeClass("col-8").addClass("col-12");
                    document.querySelector("#form-phieunhap").reset()
                }
            })
        })
    })
}
function thongkenhap(){
    $(".model-right.active").removeClass("active")
    $(".model-thongkenhap").addClass("active")
    $(".model-thongkenhap").html(`<div class="top-menu">
    <ul class="list-group list-group-horizontal menu-container">
        <li class="list-group-item model-item">Phiếu nhập trong ngày</li>
        <li class="list-group-item model-item">Danh sách phiếu nhập</li>
    </ul>
    </div>
    <div class="model-content-kho">
    </div>`)
    
    $(".model-item").click(function (e) {
        $(".model-item.active").removeClass("active")
        if (e.target.innerText == "Phiếu nhập trong ngày") {
            $(this).addClass("active")
        }
        else if(e.target.innerText=="Danh sách phiếu nhập"){
            $(this).addClass("active")
        }
    })
}

function setValueForm(event){
    $("#form-phieunhap").fadeToggle(function(){
        var isPanelHidden = $(this).is(":hidden");
        if (isPanelHidden) {
            $(".table-content-nhap").removeClass("col-8").addClass("col-12");
        } else {
            $(".table-content-nhap").removeClass("col-12").addClass("col-8");
        }
    })
    const dataE=event.target.parentNode
    const inputE=document.querySelector("#form-phieunhap").querySelectorAll("input")
    for (var i = 0; i < 2; i++) {
        inputE[i].value = dataE.cells[i].textContent;
    }
}
function handleLuuPhieu(){
    var tableE=document.querySelector("#table_phieunhap")
    if(table.rows.length>0){
        //Xử lý lưu phiếu nhập vào DB
        
    }
}
function qlncc() {
    $(".model-right.active").removeClass("active")
    $(".model-nhacc").addClass("active")
    $(".model-nhacc").html(`<div class="top-menu">
    <ul class="list-group list-group-horizontal menu-container">
        <li class="list-group-item model-item">Danh sách nhà cung cấp</li>
        <li class="list-group-item model-item">Thêm nhà cung cấp</li>
    </ul>
    </div>
    <div class="model-content-nhacc">
    </div>`)
    $(".model-item").click(function (e) {
        $(".model-item.active").removeClass("active")
        if (e.target.innerText == "Danh sách nhà cung cấp") {
            $(this).addClass("active")
            $(".model-content-nhacc").load("pages/module/nhacungcap.php", function () {
                new DataTable('#dataTable');
                $("#search").keypress(function (e) {
                    e.stopPropagation()
                    if (e.key = "Enter") {
                        xhr = new XMLHttpRequest();
                        xhr.open("POST", "./pages/module/nhacungcap.php")
                        xhr.setRequestHeader("Content-Type", "application/json");
                        xhr.send("data=" + $(this).val())
                        xhr.onload = function () {
                            if (xhr.status >= 200 && xhr.status < 300) {
                                var data = JSON.parse(xhr.response);
                                console.log(data)
                            }
                        }
                    }

                })

            })
        }
        else if (e.target.innerText == "Thêm nhà cung cấp") {
            $(this).addClass("active")
            $(".model-content-nhacc").load("./pages/themncc.php")
        }

    })
}
function suanhacc(mancc) {
    $(".model-content-nhacc").load("./pages/module/loadncc.php?MaNCC=" + mancc, function () {
        $("#btn-register").removeClass("btn-default")
        Validator({
            form: "#form-sua",
            rules: [
                Validator.isRequired("#TenNCC"),
                Validator.isRequired("#DiaChi"),
                Validator.isRequired("#Email"),
                Validator.isRequired("#SoDienThoai"),
                
            ],
            onSubmit: function(value){
                
                xhr=new XMLHttpRequest();
                xhr.open('POST','./pages/module/nhaCC.php?suanhacc');
                xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
                value['MaNCC']=mancc;
                xhr.send("dataJSON="+JSON.stringify(value))
                xhr.onload=function(){
                    if(xhr.status>=200 && xhr.status<300){
                        console.log(xhr.responseText)
                        if(xhr.responseText>0){
                            alert("Sửa thành công");
                            $(".model-content-nhacc").load("pages/module/nhacungcap.php");
                    }
                    }
                }
            }
        })
    });

}
function xoanhacc(mancc) {
    const flag = confirm("Bạn có chắc muốn xóa nhà cung cấp này không?")
    if (flag) {
        xhr = new XMLHttpRequest();
        xhr.open("GET", "./pages/module/nhaCC.php?xoanhacc=" + mancc)
        xhr.send()
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 300) {
                alert("Xóa nhà cung cấp thành công")
            }
        }
    }
}