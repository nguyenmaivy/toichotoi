(function ($) {
    "use strict";
    
    // Dropdown on mouse hover
    $(document).ready(function () {
        function toggleNavbarMethod() {
            if ($(window).width() > 992) {
                $('.navbar .dropdown').on('mouseover', function () {
                    $('.dropdown-toggle', this).trigger('click');
                }).on('mouseout', function () {
                    $('.dropdown-toggle', this).trigger('click').blur();
                });
            } else {
                $('.navbar .dropdown').off('mouseover').off('mouseout');
            }
        }
        toggleNavbarMethod();
        $(window).resize(toggleNavbarMethod);
    });
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Vendor carousel
    $('.vendor-carousel').owlCarousel({
        loop: true,
        margin: 29,
        nav: false,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            0:{
                items:2
            },
            576:{
                items:3
            },
            768:{
                items:4
            },
            992:{
                items:5
            },
            1200:{
                items:6
            }
        }
    });


    // Related carousel
    $('.related-carousel').owlCarousel({
        loop: true,
        margin: 29,
        nav: false,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:2
            },
            768:{
                items:3
            },
            992:{
                items:4
            }
        }
    });


    // Product Quantity
    $('.quantity button').on('click', function () {
        var button = $(this);
        var oldValue = button.parent().parent().find('input').val();
        if (button.hasClass('btn-plus')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        button.parent().parent().find('input').val(newVal);
    });
    
})(jQuery);
/*
// Xem danh sách sản phẩm trong localstorage cách 1
function ShowProducts(){
    var jsondanhSachSanPham = localStorage.getItem('productss');
    var DanhSachSanPham = JSON.parse(jsondanhSachSanPham);
    console.log(DanhSachSanPham);
    return DanhSachSanPham;    
}

 var danhSachSanPham = ShowProducts();
function ShowProductsHTML(danhSachSanPham){
var HTMLDanhSachSanPham = `<div class="product-detail">`;
for (var i = 0; i < danhSachSanPham.length; i++){
    var productss1 = danhSachSanPham[i];
    var htmlSanPham = ChuyenProductHTML(productss1);
    HTMLDanhSachSanPham = HTMLDanhSachSanPham + htmlSanPham;
}
HTMLDanhSachSanPham = HTMLDanhSachSanPham + `</div>`;
return HTMLDanhSachSanPham;
}
var productDetailContainer = document.getElementById('productDetailContainer');
productDetailContainer.innerHTML = ShowProductsHTML(danhSachSanPham);
// function ChuyenProductHTML(productss){
//     let html = `<div class="col-lg-4 col-md-6 col-sm-12 pb-1">
//     <div class="card product-item border-0 mb-4">
//         <div
//             class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
//             <img class="img-fluid w-100" src="${productss.img}" alt="">
//         </div>
//         <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
//             <h6 class="text-truncate mb-3">${productss.title}</h6>
//             <div class="d-flex justify-content-center">
//                 <h6>${productss.price}</h6>
//                 <h6 class="text-muted ml-2"><del>123.00</del></h6>
//             </div>
//         </div>
//         <div class="card-footer d-flex justify-content-between bg-light border">
//             <a href="" class="btn btn-sm text-dark p-0"><i
//                     class="fas fa-eye text-primary mr-1"></i>Xem nhanh</a>
//             <a href="" class="btn btn-sm text-dark p-0"><i
//                     class="fas fa-shopping-cart text-primary mr-1"></i>Thêm vào giỏ hàng</a>
//         </div>
//     </div>
// </div>`
// return html;
// }
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
                        <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Xem nhanh</a>
                        <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Thêm vào giỏ hàng</a>
                    </div>
                </div>
            </div>
        `;
    }
    return html;
}
ShowProductsHTML(danhSachSanPham);*/
// Xem danh sách sản phẩm trong localstorage cách 2

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
// Phân trang cho sản phẩm
// cách 1
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

// cách 2
/*let currentPage = 1;
let perPage = 12; 
let totalPage = 0;
let perProducts = [];
function getProducts(){
    perProducts = danhSachSanPham.slice(
        (currentPage - 1)*perPage,
        (currentPage - 1)*perPage + perPage,
    )
    renderPageNumber()
    var productDetailContainer = document.getElementById('productDetailContainer');
    productDetailContainer.innerHTML = ShowProductsHTML(perProducts);
}
function renderPageNumber(){
    totalPage = danhSachSanPham.length / perPage;
    for( let i = 0; i <= totalPage; i++){
        document.querySelector('.page-nav-list').innerHTML += `<li onclick="handlePageNumber(${i})">${i}</li>`;
    }
}
function handlePageNumber(num){
    currentPage = num;
    perProducts = danhSachSanPham.slice(
        (currentPage - 1)*perPage,
        (currentPage - 1)*perPage + perPage,
    )
}*/
//chuyển hướng trang web
