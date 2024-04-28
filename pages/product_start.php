
<?php
require_once("sanpham.php");
require_once("product_actions.php");

// Khởi tạo kết nối
$db = new ConnectDB();

?>
<?php
// Gọi hàm fetchSanpham để lấy danh sách sản phẩm từ cơ sở dữ liệu
$sanpham = fetchSanpham($db->conn);
?>

<!-- Hiển thị danh sách sản phẩm từ cơ sở dữ liệu -->
<?php foreach ($sanpham as $sp): ?>
    <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
        <div class="card product-item border-0 mb-4">
            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                <img class="img-fluid w-100" src="./img/<?php echo $sp['HinhAnh']; ?>" alt="<?php echo $sp['TenSP']; ?>">
            </div>
            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                <h6 class="text-truncate mb-3"><?php echo $sp['TenSP']; ?></h6>
                <div class="d-flex justify-content-center">
                    <h6><?php echo $sp['GiaSP']; ?></h6>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between bg-light border">
                 
                <!-- Nút Thêm vào Giỏ Hàng -->
                <form class="addcart-form" method="POST" action="cart.php">
                    <input type="hidden" name="MaSP" value="<?php echo $sp['MaSP']; ?>">
                    <input type="hidden" name="HinhAnh" value="<?php echo $sp['HinhAnh']; ?>">
                    <input type="hidden" name="TenSP" value="<?php echo $sp['TenSP']; ?>">
                    <input type="hidden" name="GiaSP" value="<?php echo $sp['GiaSP']; ?>">
                    <button type="submit" name="addcart">Thêm vào giỏ hàng</button>
                </form>
                 <!-- Nút Xem Nhanh -->
                 <?php echo showQuickViewButton($sp['MaSP']); ?>

            </div>
        </div>
    </div>
<?php endforeach; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $(".addcart-form").submit(function(event){
            var form = $(this);
            $.ajax({
                type: "POST",
                url: form.attr('action'), // Get the action URL from the form
                data: form.serialize(), // Serialize form data
                success: function(response){
                    alert("Sản phẩm đã được thêm vào giỏ hàng!");
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Log any errors to the console
                    alert("Đã xảy ra lỗi. Vui lòng thử lại sau!");
                }
            });
        });
    });
</script>
