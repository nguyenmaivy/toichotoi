<?php
require('pages/connect_cuatui.php');
$conn = new ConnectDB();
if ($conn->conn->connect_error) {
    die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->conn->connect_error);
}

$id = $_GET['id'];
$result = mysqli_query($conn->conn, "SELECT * FROM `sanpham`
INNER JOIN thuonghieu ON sanpham.MaTH=thuonghieu.MaTH 
INNER JOIN danhmucsp ON sanpham.MaDM=danhmucsp.MaDM
WHERE  MaSP='$id'");
$product = mysqli_fetch_assoc($result);
$result = mysqli_query($conn->conn, "SELECT COUNT(*) AS total FROM `chitietdonhang` WHERE MaSP=$id");
$total = mysqli_fetch_assoc($result);
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
    <!-- <div class="modal-header">
        <img class="product-image" src="img/" alt="">
    </div>
    <div class="modal-body">
        <h2 class="product-title"><?= $product['TenSP'] ?></h2>
        <div class="product-control">
            <div class="priceBox">
                <span class="current-price"><?= $product['GiaSP'] ?></span>
            </div>
            <div class="buttons_added">
                <input class="minus is-form" type="button" value="-" onclick="decreasingNumber(this)">
                <input class="input-qty" max="100" min="1" name="" type="number" value="1">
                <input class="plus is-form" type="button" value="+" onclick="increasingNumber(this)">
            </div>
        </div>
    </div> -->
    <div class="container">
        <div class="row">
            <div class="col-lg-5 ">
                <div class="m-4 rounded">
                    <img src="img/<?= $product['HinhAnh'] ?>" alt="" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-7 ">
                <div class="mt-4 bg-white p-4 rounded">
                    <h4 class="fw-bold"><?= $product['TenSP'] ?></h4>
                    <div class="row row-cols-2">
                        <div class="">Danh mục: <h6 class="d-inline "><?= $product['TenDanhMuc'] ?></h6>
                        </div>
                        <div class="">Thương hiệu: <h6 class="d-inline"><?= $product['TenTH'] ?></h6>
                        </div>
                        <div class="">Xuất xứ: <h6 class="d-inline"><?= $product['XuatXu'] ?></h6>
                        </div>
                        <div class="">Số lượng: <h6 class="d-inline"><?= $product['SoLuongSP'] ?></h6>
                        </div>
                        <div class="">Đã bán: <h6 class="d-inline"><?= $total['total'] ?></h6>
                        </div>
                        <div class="">Giá tiền: <h6 class="d-inline text-danger"><?= $product['GiaSP'] ?> đ</h6>
                        </div>
                    </div>
                </div>
                <div class="mt-4 bg-white p-4 rounded">
                    <h5>Thông tin chi tiết</h5>
                    <div class="book-detail">
                        <div class="fw-light py-2 border-bottom">Mã sản phẩm</div>
                        <div class="border-bottom py-2"><?= $product['MaSP'] ?></div>
                        <!-- <div class="fw-light py-2 border-bottom">Tên nhà cung cấp</div>
                        <div class="border-bottom py-2">{{this.supplier.name}}</div>
                        <div class="fw-light py-2 border-bottom">Tác giả</div>
                        <div class="border-bottom py-2">{{this.author}}</div>
                        <div class="fw-light py-2 border-bottom">NXB</div>
                        <div class="border-bottom py-2">{{this.publisher.name}}</div>
                        <div class="fw-light py-2 border-bottom">Năm NXB</div>
                        <div class="border-bottom py-2">{{this.publication_date}}</div>
                        <div class="fw-light py-2 border-bottom">Ngôn ngữ</div>
                        <div class="border-bottom py-2">{{this.language}}</div>
                        <div class="fw-light py-2 border-bottom">Trọng lượng (gr)</div>
                        <div class="border-bottom py-2">{{this.weight}}</div>
                        <div class="fw-light py-2 border-bottom">Kích thước bao bì</div>
                        <div class="border-bottom py-2">{{this.size}}</div>
                        <div class="fw-light py-2 border-bottom">Sô trang</div>
                        <div class="border-bottom py-2">{{this.number_of_pages}}</div>
                        <div class="fw-light py-2 border-bottom">Hình thức</div>
                        <div class="border-bottom py-2">{{this.book_layout}}</div> -->
                    </div>
                </div>
                <div class="mt-4 bg-white p-4 rounded">
                    <h5>Mô tả sản phẩm</h5>
                    <h6><?= $product['TenSP'] ?></h6>
                    <p>
                        Sản phẩm này không chỉ giúp làm sáng vùng da mắt mà còn có thể sử dụng cho toàn bộ khuôn mặt, mang lại hiệu quả dưỡng da toàn diện1.

                        Đặc điểm nổi bật:
                        Chống lão hóa: Chứa các thành phần chống oxy hóa mạnh mẽ như vitamin C và glutathione, giúp ngăn ngừa và cải thiện nếp nhăn, quầng thâm1.
                        Dưỡng ẩm sâu: Hyaluronic acid và Alpha-bisabolol giúp cấp nước sâu cho da, cải thiện độ đàn hồi và làm da săn chắc hơn1.
                        Làm sáng da: Công thức Gluta-i Complex™ độc quyền giúp làm sáng màu da trong 14 ngày1.
                        Kết cấu mỏng nhẹ: Công nghệ Micro Capsule giúp kem thẩm thấu nhanh, không gây nhờn rít1.
                        Hướng dẫn sử dụng:
                        Sáng và tối: Sử dụng hai lần mỗi ngày, vào buổi sáng và buổi tối, sau các bước chăm sóc da khác.
                        Vùng da mắt và mặt: Lấy một lượng kem vừa đủ, vỗ nhẹ lên vùng da mắt và các vùng da mặt có nếp nhăn như trán, rãnh cười, cằm, sau đó mát xa nhẹ nhàng để kem thẩm thấu tốt hơn2.
                        Bạn đã từng sử dụng sản phẩm này chưa? Nếu có, bạn cảm thấy hiệu quả như thế nào?
                    </p>
                </div>
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
            <span class="price"><?= $product['GiaSP'] ?></span>
        </div>
        <div class="modal-footer-control">
            <button class="button-dat" id="add-cart" onclick="AddCart(<?= $product['MaSP'] ?>)"><i class="fa-light fa-basket-shopping">Thêm giỏ hàng</i></button>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="js/home.js"></script>
</body>

</html>