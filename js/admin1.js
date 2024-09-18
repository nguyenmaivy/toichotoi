const currentLogin = JSON.parse(sessionStorage.getItem("currentLogin"));
if(!currentLogin || !currentLogin.quyen) {
    alert("Chưa đăng nhập")
    window.location.href='index.php'
}
function activateNavLink(selector, actionFunction) {
    $(selector).click(function () {
        $(".nav-link.active").removeClass("active");
        $(this).find("a").addClass("active");
        $(this).parent().parent().find("> a").addClass("active");
        return actionFunction && actionFunction();
    });
}
activateNavLink(".js_home", ChartNe);
if (currentLogin.quyen == 'Admin') {
    activateNavLink(".js_qlsp", qlkho);
    activateNavLink(".js_qlncc", qlncc);
    activateNavLink(".js_nhapkho", nhapkho);
    activateNavLink(".js_thongkenhap", thongkenhap);
    activateNavLink(".js_qltk", qlTaiKhoan);
    activateNavLink(".js_qldh", duyetdonhang);
    activateNavLink(".js_thongkebh", xemThongKe);
}
else if (currentLogin.quyen == 'QLBH') {
    activateNavLink(".js_qltk", qlTaiKhoan);
    activateNavLink(".js_thongkebh", xemThongKe);
    activateNavLink(".js_qldh", duyetdonhang);
}
else if (currentLogin.quyen == 'QLK') {
    activateNavLink(".js_qlsp", qlkho);
    activateNavLink(".js_qlncc", qlncc);
    activateNavLink(".js_nhapkho", nhapkho);
    activateNavLink(".js_thongkenhap", thongkenhap);
}
var dataThongKe=[]
function GetValue(){
    var xhr=new XHR()
    return xhr.connect(undefined,"./pages/module/nhaCC.php?hoadon")
    .then(function(data){
        console.log(data)
        dataThongKe=JSON.parse(data)
    })
}
GetValue()
function ChartNe() {
    $(".content-wrapper").html(`<canvas id="myChart" width="400" height="400"></canvas>`);
    function number_format(number, decimals, dec_point, thousands_sep) {
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }
    console.log(dataThongKe)
    var ctx = document.getElementById('myChart').getContext('2d');
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
            datasets: [{
                label: "Doanh thu",
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: dataThongKe,
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: 'month'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 12
                    }
                }],
                yAxes: [{
                    ticks: {
                        maxTicksLimit: 5,
                        padding: 10,
                        callback: function (value, index, values) {
                            return '$' + number_format(value);
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: false
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                    label: function (tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
                    }
                }
            }
        }
    });

}
function qlkho() {
    $(".content-wrapper").html(`<div class="top-menu">
    <ul class="list-group list-group-horizontal menu-container">
        <li class="list-group-item model-item">Danh sách sản phẩm</li>
        <li class="list-group-item model-item">Thêm sản phẩm</li>
        <li class="list-group-item model-item " data-bs-toggle="modal" data-bs-target="#">Thêm thương hiệu</li>
        
    </ul>
    </div>
    <div class="model-content-kho">
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
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
    })
}
function xoasanpham(masp,soluong) {
    if(soluong>0){
        alert("Không thể xóa sản phẩm khi vẫn còn tồn kho")
        return;
    }
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

            ],
            onSubmit: function (value) {
                const form = document.querySelector("#formanh");
                //Luồng gửi ảnh
                var formData = new FormData(form);

                var xhfile = new XMLHttpRequest();
                xhfile.open("POST", "./pages/module/upload.php?id=" + masp);

                xhfile.onreadystatechange = function () {
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
                xhr = new XMLHttpRequest();
                xhr.open('POST', './pages/module/sanpham.php?suasp');
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                value['MaSP'] = masp;
                xhr.send("dataJSON=" + JSON.stringify(value))
                xhr.onload = function () {
                    if (xhr.status >= 200 && xhr.status < 300) {
                        console.log(xhr.responseText)
                        if (xhr.responseText > 0) {
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
function qlncc() {
    $(".content-wrapper").html(`<div class="top-menu">
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
var dataPhieuNhap = {};
var dataCTPN = [];
function nhapkho() {
    // $(".model-right.active").removeClass("active")
    // $(".model-qlkho").addClass("active")
    $(".content-wrapper").load("./pages/nhapkho.php", function () {
        new DataTable('#table_nhapkho-sanpham');
        $.get("./pages/module/phieunhap.php?row", function (data, status) {
            dataPhieuNhap['maPhieuNhap'] = Number(data) + 1;
        });
        dataPhieuNhap['tongTien'] = 0;
        dataPhieuNhap['maNhanVien'] = '0123456789'

        $(".them-phieunhap").click(function () {
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
                onSubmit: function (value) {
                    var tableE = document.querySelector("#table_phieunhap")
                    var newRow = tableE.insertRow();
                    let data = new Object();
                    var newcell0 = newRow.insertCell(0)
                    newcell0.innerHTML = value['f_pn_MaSP'];
                    var newcell1 = newRow.insertCell(1)
                    newcell1.innerHTML = value['f_pn_TenSP'];
                    var newcell2 = newRow.insertCell(2)
                    newcell2.innerHTML = value['f_pn_soluong'];
                    var newcell3 = newRow.insertCell(3)
                    newcell3.innerHTML = value['f_pn_dongia'];
                    var newcell4 = newRow.insertCell(4)
                    newcell4.innerHTML = Number(value['f_pn_soluong']) * Number(value['f_pn_dongia'])
                    $(".item-nhapkho.pannel").slideToggle("show")
                    $(".table-content-nhap").removeClass("col-8").addClass("col-12");
                    document.querySelector("#form-phieunhap").reset()
                    data['maPhieuNhap'] = dataPhieuNhap['maPhieuNhap']
                    data['soLuong'] = value['f_pn_soluong'];
                    data['donGia'] = value['f_pn_dongia'];
                    data['maSP'] = value['f_pn_MaSP'];
                    data['GiaSP']=$('.js_giaban').text()
                    dataCTPN.push(data)
                    dataPhieuNhap['tongTien'] += data['soLuong'] * data['donGia']
                    $(".tongtien-phieunhap").text(dataPhieuNhap['tongTien'])
                }
            })
        })
    })
}
function setValueForm(event) {
    $("#form-phieunhap").fadeToggle(function () {
        var isPanelHidden = $(this).is(":hidden");
        if (isPanelHidden) {
            $(".table-content-nhap").removeClass("col-8").addClass("col-12");
        } else {
            $(".table-content-nhap").removeClass("col-12").addClass("col-8");
        }
    })
    const dataE = event.target.parentNode
    var inputE;
    const formPhieuNhap = document.getElementById('form-phieunhap');
    let stringHTML=`<div class=" form-group m-4">
                        <label for="form_phieunhap-MaSP">Mã sản phẩm:</label>
                        <input id="form_phieunhap-MaSP" name="f_pn_MaSP" class="float-end">
                        <p class="form-message"></p>
                    </div>
                    <div class=" form-group m-4">
                        <label for="form_phieunhap-TenSP">Tên sản phẩm:</label>
                        <input id="form_phieunhap-TenSP" name="f_pn_TenSP" class="float-end">
                        <p class="form-message"></p>
                    </div>
                    <div class=" form-group m-4">
                        <label for="form_phieunhap-soluong">Số lượng:</label>
                        <input id="form_phieunhap-soluong" name="f_pn_soluong" class="float-end">
                        <p class="form-message"></p>
                    </div>
                    <div class=" form-group m-4">
                        <label for="form_phieunhap-dongia">Đơn giá:</label>
                        <input id="form_phieunhap-dongia" name="f_pn_dongia" class="float-end">
                        <p class="form-message"></p>
                    </div>`
    var map=[];
    let j=0;
    while(dataE.cells[j]){
        map.push(dataE.cells[j].textContent)
        j++
    }
    if(map[3]==0){
        stringHTML+=`<div class=" form-group m-4">
        <label for="form_phieunhap-dongia">Hệ số lãi:</label>
        <input name="f_pn_lai" class="float-end">
        <p class="form-message"></p>
        <div >Giá bán:<span class="js_giaban"></span></div>
        </div>`
    }
    formPhieuNhap.innerHTML=stringHTML+`<div class="modal_content-btn-box">
    <button type="submit" class="btn btn-primary btn-default">Xác nhận thêm</button>
    </div>`
    inputE = document.querySelector("#form-phieunhap").querySelectorAll("input");
    for (var i = 0; i < 2; i++) {
        inputE[i].value=map[i]
    }
    $('[name="f_pn_lai"]').on('keyup', function(){
        console.log("cmmm");
        let dongia = Number($('[name="f_pn_dongia"]').val());
        let lai = Number($(this).val());
        let giaban = dongia + (dongia * lai / 100); 
        console.log(giaban)
        $('.js_giaban').html(giaban);
    });
    
}
function thongkenhap() {
    // $(".model-right.active").removeClass("active")
    // $(".model-thongkenhap").addClass("active")
    $(".content-wrapper").html(`<div class="top-menu">
    <ul class="list-group list-group-horizontal menu-container">
        <li class="list-group-item model-item">Danh sách phiếu nhập</li>
    </ul>
    </div>
    <div class="model-content-kho">
    </div>`)

    $(".model-item").click(function (e) {
        $(".model-item.active").removeClass("active")
        if (e.target.innerText == "Danh sách phiếu nhập") {
            $(this).addClass("active")
            $(".model-content-kho").load("./pages/thongkephieunhap.php", function () {
            })
        }

    })
}
function handleLuuPhieu(flag) {
    var tableE = document.querySelector("#table_phieunhap")
    if (tableE.rows.length > 1) {
        if (flag == 'luu') {
            luu()
            ModalThongBao('Thành công', 'Đơn hàng đã được thêm thành công')

        }
        else if (flag == "luuin") {
            luu()
            inphieu()
        }
    } else {
        ModalThongBao('Thất bại', 'Đơn hàng rỗng', 'danger')
    }
    function luu() {
        dataPhieuNhap['maNhaCC'] = $("#form_phieunhap-nhacc").val()
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "./pages/module/phieunhap.php")
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.send("phieunhap=" + JSON.stringify(dataPhieuNhap) + "&chitietphieunhap=" + JSON.stringify(dataCTPN))
        dataCTPN=[];
        nhapkho()
        $(".item-menu.active").click();
    }
    function inphieu() {
        window.open("./hoadon.php?phieunhap&id=" + dataPhieuNhap['maPhieuNhap']);
    }
}
function xemchitietnhap(id) {
    $(".table-content").load("./pages/chitietnhap.php?id=" + id)
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
function inphieunhap(id) {
    window.open("./hoadon.php?phieunhap&id=" + id);
}
function ClickTrangChu() {
    $("#trang_chu").click(function () {

    })
}
function qlTaiKhoan() {
    // $(".model-right.active").removeClass("active")
    // $(".model-tk").addClass("active")
    $(".content-wrapper").load("./pages/admin/qltaikhoan.php", function () {
        RenderTableAccount()
        $(".js_search_tk").on("input", function (e) {
            SearchTaiKhoan(e)
        })
    })
    // $(".model-item").click(function (e) {
    //     $(".model-item.active").removeClass("active")
    //     if (e.target.innerText == "Thêm tài khoản") {
    //         $(this).addClass("active")
    //         $(".model-content-qltk").load("./pages/themtk.php")
    //     }
    //     else if (e.target.innerText == "Sửa tài khoản") {
    //         $(this).addClass("active")
    //         console.log("cmm")
    //         $(".model-content-qltk").load("./pages/timtk.php?status=1")
    //     }
    //     else if (e.target.innerText == "Xóa tài khoản") {
    //         $(this).addClass("active")
    //         $(".model-content-qltk").load("./pages/timtk.php?status=2")
    //     }
    // })
}
function duyetdonhang() {
    $(".content-wrapper").html(`<div class="top-menu">
    <ul class="list-group list-group-horizontal menu-container">
        <li class="list-group-item model-item">Danh sách đơn hàng</li>
        <li class="list-group-item model-item">Lọc danh sách đơn hàng chưa duyệt</li>
    </ul>
    </div>
    <div class="model-content-hd">
    </div>`)
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
    $(".table-content").load("./pages/module/xlinhoadon.php?donhang&id=" + id, function () {
        $(".print-pdf").click(function (e) {
            e.stopPropagation();
            window.open("./hoadon.php?donhang&id=" + id);
        })
        $(".btn-loaddon").click(function () {
            $(".table-content").load("./pages/module/loaddon.php", function () {
                viewDuyet();
            });
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
function timdonhang(event) {

    if (event.key == "Enter") {
        $.post("./pages/module/loaddon.php?timdon",
            {
                SDT: $(".search-donhang").val(),
            },
            function (data, status) {
                $(".model-content-hd").html(data)
                viewDuyet()
            });
    }
}
function xemThongKe() {
    // $(".model-right.active").removeClass("active")
    // $(".model-thongke").addClass("active")
    $(".content-wrapper").html(` <div class="top-menu">
    <ul class="list-group list-group-horizontal menu-container">
        <li class="list-group-item model-item">Báo cáo hôm nay</li>
        <li class="list-group-item model-item">Báo cáo theo khoảng thời gian</li>
    </ul>
    </div>
    <div class="model-content-tkbh mt-5 m-2">
    </div>`)
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
function handTimeTK() {
    var from = $("#from-time-tk").val();
    var to = $("#to-time-tk").val();
    $(".baocao").load("./pages/thongkeban.php?khoang&from=" + from + "&to=" + to, function () {
    })
}
function ModalThongBao(tittle, message, status = 'success') {

    // Tạo một phần tử div mới
    var modalDiv = document.createElement('div');
    modalDiv.className = 'modal';
    modalDiv.id = 'myModal';

    // Tạo cấu trúc modal và thêm vào phần tử div vừa tạo 
    modalDiv.innerHTML = `
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title text-${status}">${tittle}</h4>
                    <button type="button" class="btn-close" onclick="CloseModal()"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    ${message}
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-${status}" onclick="CloseModal()">Close</button>
                </div>
            </div>
        </div>
    `;
    // Chọn thẻ div để chèn modal vào đó
    var parentDiv = document.querySelector('body'); // Thay 'divId' bằng id của thẻ div mong muốn

    // Thêm modal vào thẻ div mẹ
    parentDiv.appendChild(modalDiv);
    $("#myModal").fadeIn("slow", function () {
        $("#myModal").fadeOut(3000, function () {
            $(this).remove()
        })
    });
}

function CloseModal() {
    var modal = document.getElementById('myModal');
    if (modal) {
        $(modal).stop(true, true).remove(); // Dừng tất cả hiệu ứng và xóa modal
    }
}