<?php
require_once("sanpham.php");
require_once("product_actions.php");

// Khởi tạo kết nối
$db = new ConnectDB();

?>

<form method="GET" action="">
    <?php
    // Gọi hàm fetchSanpham để lấy danh sách sản phẩm từ cơ sở dữ liệu
    $sanpham = fetchSanpham($db->conn);
    ?>
    
    <!-- Hiển thị danh sách sản phẩm từ cơ sở dữ liệu -->
    <?php foreach ($sanpham as $sp): ?>
        <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <img class="img-fluid w-100" src="<?php echo $sp['HinhAnh']; ?>" alt="<?php echo $sp['TenSP']; ?>">
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <h6 class="text-truncate mb-3"><?php echo $sp['TenSP']; ?></h6>
                    <div class="d-flex justify-content-center">
                        <h6><?php echo $sp['GiaSP']; ?></h6>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between bg-light border">
                    <!-- Nút Xem Nhanh -->
                    <?php echo showQuickViewButton($sp['MaSP']); ?>
                    <!-- Nút Thêm vào Giỏ Hàng -->
                    <?php echo showAddToCartButton($sp['MaSP']); ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</form>
