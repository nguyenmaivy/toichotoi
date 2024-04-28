
<?php
require('pages/connect_cuatui.php');
$conn = new ConnectDB();
if ($conn->conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->conn->connect_error);
}

$id = $_GET['id'];
$result = mysqli_query($conn->conn, "SELECT * FROM `sanpham` WHERE `MaSP` = '$id'");
$product = mysqli_fetch_assoc($result);
// $img = mysqli_query($conn->conn, "SELECT `HINHANH` FROM `sanpham` WHERE `MaSP` = '$id'");
// $product['image'] = mysqli_fetch_all($img , MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Belleza | Mỹ phẩm & phục hồi chức năng</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <link rel="icon" href="/img/ảnh logo/4.png" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="modal-header">
    <img class="product-image" src="img/<?=$product['HinhAnh']?>" alt="">
    </div>
    <div class="modal-body">
        <h2 class="product-title"><?=$product['TenSP']?></h2>
        <div class="product-control">
            <div class="priceBox">
                <span class="current-price"><?=$product['GiaSP']?></span>
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
            <span class="price"><?=$product['GiaSP']?></span>
        </div>
        <div class="modal-footer-control">
            <button class="button-dathangngay" data-product="${infoProduct.id}">Đặt hàng ngay</button>
            <button class="button-dat" id="add-cart" onclick="AddCart(<?=$product['MaSP']?>)"><i class="fa-light fa-basket-shopping">Thêm giỏ hàng</i></button>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="js/home.js"></script>
    </body>
</html>