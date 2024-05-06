$(document).ready(function () {
    if(Cart['arr']){
        $(".js_numcart").text(Cart['arr'].length)
    }
    const root = $("#root");
    $('.nav-top').click(function (e) {
        $('.nav-link').removeClass("active");

        switch (e.target.innerText) {
            case 'Trang chủ':
                root.load("./pages/home.php", function () {
                    $(e.target).addClass("active");
                });
                break;
            case 'Sản phẩm':
                root.load("./pages/shop.php", function () {
                    // load_DSSP();
                    $(e.target).addClass("active");
                    $(".btn_searchsp").click(function () {
                        SearchSP()
                    })
                    $("#input_searchsp").keypress(function (e) {
                        if (e.keyCode === 13) {
                            SearchSP()
                        }
                    })
                    $("#price_sp").submit(function (event) {
                        event.preventDefault();
                        var value = {}
                        var tmp = $(this).serialize().split('=')[1]

                        var formData = new FormData(document.querySelector("#danhmuc_form"))
                        value['alldm'] = formData.get("alldm")
                        value['price'] = tmp
                        var i = 1;
                        value['dm'] = []; // Khởi tạo value['dm'] là một mảng trống
                        formData.forEach((properti, key) => {

                            if (key.indexOf('all') == -1 && properti) {
                                value['dm'].push(properti)
                            }
                        })
                        console.log(value['dm'])
                        var xhr = new XMLHttpRequest;
                        xhr.open("POST", "./pages/price_event.php")
                        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        value = JSON.stringify(value)
                        xhr.send("data=" + value);
                        xhr.onload = function () {
                            // console.log(xhr.responseText);
                            $("#productDetailContainer").html(xhr.responseText)
                        }


                    })
                });
                break;
            case 'Góp ý':
                root.load("./pages/contact.php", function () {
                    $(e.target).addClass("active");
                });
                break;
            case 'Thanh toán':
                root.load("./pages/checkout.php", function () {
                });
                break;
            case 'Giỏ hàng':
                root.load("./pages/cart.php", function () {
                    RenderGioHang();
                    $(e.target).addClass("active");
                    $(".js_dathang").on("click",function () {
                        DonHang()
                    })
                });
                break;
        }
    });
    function load_DSSP() {
        function ShowProducts() {
            var jsondanhSachSanPham = localStorage.getItem('productss');
            var DanhSachSanPham = JSON.parse(jsondanhSachSanPham);
            console.log(DanhSachSanPham);
            return DanhSachSanPham;
        }

        function ShowProductsHTML(productss) {
            let html = '';
            for (let i = 0; i < productss.length; i++) {
                html += `
                <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100" src="${productss[i].img}" alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">${productss[i].title}</h6>
                            <div class="d-flex justify-content-center">
                                <h6>${productss[i].price}</h6>
                                <h6 class="text-muted ml-2"><del>123.00</del></h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="" class="btn btn-sm text-dark p-0" onclick="detailProduct(${productss[i].id})"><i class="fas fa-eye text-primary mr-1"></i>Xem nhanh</a>
                            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Thêm vào giỏ hàng</a>
                        </div>
                    </div>
                </div>
            `;

            }
            return html;
        }
        var danhSachSanPham = ShowProducts();
        $("#productDetailContainer").html(ShowProductsHTML(danhSachSanPham));
        //Phan trang chu sản phẩm
        let perPage = 12;
        let currentPage = 1;
        let totalPage = 0;
        let perProducts = [];
        var productAll = JSON.parse(localStorage.getItem('productss')).filter(item => item.status == 1);
        function displayList(productAll, perPage, currentPage) {
            let start = (currentPage - 1) * perPage;
            let end = (currentPage - 1) * perPage + perPage;
            let productShow = productAll.slice(start, end);
            var productDetailContainer = document.getElementById('productDetailContainer');
            productDetailContainer.innerHTML = ShowProductsHTML(productShow);
        }

        function showHomeProduct(products) {
            let productAll = products.filter(item => item.status == 1)
            displayList(productAll, perPage, currentPage);
            setupPagination(productAll, perPage, currentPage);
        }

        window.onload = showHomeProduct(JSON.parse(localStorage.getItem('productss')))

        function setupPagination(productAll, perPage) {
            document.querySelector('.page-nav-list').innerHTML = '';
            let page_count = Math.ceil(productAll.length / perPage);
            for (let i = 1; i <= page_count; i++) {
                let li = paginationChange(i, productAll, currentPage);
                document.querySelector('.page-nav-list').appendChild(li);
            }
        }

        function paginationChange(page, productAll, currentPage) {
            let node = document.createElement(`li`);
            node.classList.add('page-nav-item');
            node.innerHTML = `<a href="javascript:;">${page}</a>`;
            if (currentPage == page) node.classList.add('active');
            node.addEventListener('click', function () {
                currentPage = page;
                displayList(productAll, perPage, currentPage);
                let t = document.querySelectorAll('.page-nav-item.active');
                for (let i = 0; i < t.length; i++) {
                    t[i].classList.remove('active');
                }
                node.classList.add('active');
            })
            return node;
        }
        // xem thông tin chi tiết sản phẩm 
        function detailProduct(index) {
            let modal = document.querySelector('.modal.product-detail');
            let products = JSON.parse(localStorage.getItem('productss'));
            event.preventDefault();
            let infoProduct = products.find(sp => {
                return sp.id === index;
            })
            let modalHtml = `<div class="modal-header">
        <img class="product-image" src="${infoProduct.img}" alt="">
        </div>
        <div class="modal-body">
            <h2 class="product-title">${infoProduct.title}</h2>
            <div class="product-control">
                <div class="priceBox">
                    <span class="current-price">${infoProduct.price}</span>
                </div>
                <div class="buttons_added">
                    <input class="minus is-form" type="button" value="-" onclick="decreasingNumber(this)">
                    <input class="input-qty" max="100" min="1" name="" type="number" value="1">
                    <input class="plus is-form" type="button" value="+" onclick="increasingNumber(this)">
                </div>
            </div>
        </div>
        <div class="notebox">
                <p class="notebox-title">Ghi chú</p>
                <textarea class="text-note" id="popup-detail-note" placeholder="Nhập thông tin cần lưu ý..."></textarea>
        </div>
        <div class="modal-footer">
            <div class="price-total">
                <span class="thanhtien">Thành tiền</span>
                <span class="price">${infoProduct.price}</span>
            </div>
            <div class="modal-footer-control">
                <button class="button-dathangngay" data-product="${infoProduct.id}">Đặt hàng ngay</button>
                <button class="button-dat" id="add-cart" onclick="animationCart()"><i class="fa-light fa-basket-shopping">Thêm giỏ hàng</i></button>
            </div>
        </div>`;
            document.querySelector('#product-detail-content').innerHTML = modalHtml;
            modal.classList.add('open');
            body.style.overflow = "hidden";
            //Cap nhat gia tien khi tang so luong san pham
            let tgbtn = document.querySelectorAll('.is-form');
            let qty = document.querySelector('.product-control .input-qty');
            let priceText = document.querySelector('.price');
            tgbtn.forEach(element => {
                element.addEventListener('click', () => {
                    let price = infoProduct.price * parseInt(qty.value);
                    priceText.innerHTML = vnd(price);
                });
            });
        }
        //Click vùng ngoài sẽ tắt Popup
        const body = document.querySelector("body");
        let modalContainer = document.querySelectorAll('.modal');
        let modalBox = document.querySelectorAll('.mdl-cnt');
        let formLogSign = document.querySelector('.forms');
        modalContainer.forEach(item => {
            item.addEventListener('click', closeModal);
        });

        modalBox.forEach(item => {
            item.addEventListener('click', function (event) {
                event.stopPropagation();
            })
        });

        function closeModal() {
            modalContainer.forEach(item => {
                item.classList.remove('open');
            });
            console.log(modalContainer)
            body.style.overflow = "auto";
        }
        function increasingNumber(e) {
            let qty = e.parentNode.querySelector('.input-qty');
            if (parseInt(qty.value) < qty.max) {
                qty.value = parseInt(qty.value) + 1;
            } else {
                qty.value = qty.max;
            }
        }

        function decreasingNumber(e) {
            let qty = e.parentNode.querySelector('.input-qty');
            if (qty.value > qty.min) {
                qty.value = parseInt(qty.value) - 1;
            } else {
                qty.value = qty.min;
            }
        }
    }
})
function SearchSP() {
    var tmp = $("#input_searchsp").val()
    $.post("./pages/search.php",
        {
            data: tmp,
        },
        function (data) {
            $("#productDetailContainer").html(data)
        });
}
function handlePriceForm(event) {

}
var tongHoaDon 
function RenderGioHang() {
    var Cart = JSON.parse(localStorage.getItem("Cart")) || {};
    var tableGioHang = ''
    var bodyGioHang = ''
    tongHoaDon=0;
    if (Cart['arr']) {
        Cart['arr'].forEach((value, index) => {
            var tong = value['GiaSP'] * value['soluong']
            tongHoaDon += tong
            tableGioHang += `<tr>
            <td class="align-middle"><img src="#" alt="" style="width: 50px;"> ${value['TenSP']}</td>
            <td class="align-middle">${value['GiaSP']}</td>
            <td class="align-middle">
                <div class="input-group quantity mx-auto" style="width: 100px;">
                    <div class="input-group-btn">
                        <button class="btn btn-sm btn-primary btn-minus" onclick="GiamNe(${value['MaSP']})">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                    <input type="text" class="form-control form-control-sm bg-secondary text-center js_soluong${value['MaSP']}"
                        value="${value['soluong']}">
                    <div class="input-group-btn">
                        <button class="btn btn-sm btn-primary btn-plus" onclick="TangNe(${value['MaSP']})">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
            </td>
            <td class="align-middle">${tong}</td>
            <td class="align-middle"><button class="btn btn-sm btn-primary" onclick="DeleteCart(${index})"><i
                        class="fa fa-times"></i></button></td>
                        </tr>`
            bodyGioHang += `<div class="d-flex justify-content-between mb-3 pt-1">
            <h6 class="font-weight-medium">${value['TenSP']}</h6>
            <h6 class="font-weight-medium">${tong}</h6>
        </div>`
        })
        $(".js_table_cart").html(tableGioHang)
        $(".card-body").html(bodyGioHang)
        $(".js_tongtien").text(tongHoaDon)
        
    }
}
function DeleteCart(id) {
    console.log("Xoa cmm")
    const tableE = document.querySelector(".js_table_cart")
    console.log("truoc khi xoa", Cart['arr'])
    tableE.deleteRow(id)
    Cart['arr'].splice(id, 1)
    localStorage.setItem("Cart", JSON.stringify(Cart))
    console.log("sau khi xoa", Cart['arr'])
    $('.nav-top').each(function () {
        var text = $(this).text().trim()
        if (text == "Giỏ hàng") {
            console.log(text)
            $(this).click()
        }
    })
}
function DonHang() {
    var account = JSON.parse(sessionStorage.getItem("currentLogin"))
    var donhang = JSON.parse(localStorage.getItem("Cart"))
    if(account && donhang){
        account['tong'] = tongHoaDon
        account['arr']=donhang['arr']
        
        var xhr = new XMLHttpRequest()
        xhr.open("POST", "./pages/module/donhang.php?set")
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("dataJSON=" + JSON.stringify(account));
        xhr.onload = function () {
            var message=xhr.responseText
            if(message=="sucsess")
                alert("Đơn hàng đã đặt thành công")
            else 
                alert("Đơn hàng bị lỗi, vui lòng kiểm tra kết nối mạng")
            Cart['arr'] = null
            localStorage.setItem("Cart", JSON.stringify(Cart))
            setTimeout(function(){
                location.reload()
            },0)
        }
        
    }
    else {
        alert("Đặt hàng không thành công, vui lòng kiểm tra đăng nhập và giỏ hàng")
    }
}
function ClickIconCart(){
    const root = $("#root");
    $('.nav-top').each(function(){
        if($(this).text().trim()=="Giỏ hàng"){
            var _this=this
            root.load("./pages/cart.php", function () {
                RenderGioHang();
                $('.nav-top.active').removeClass("active")
                $(_this).addClass("active");
                console.log($(this))
                $(".js_dathang").on("click",function () {
                    DonHang()
                })
                var cart = document.getElementById("cart");
                cart.scrollIntoView({ behavior: 'smooth' });
            });
        }
    })
}