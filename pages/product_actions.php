<?php
// Hàm hiển thị nút Xem nhanh
function showQuickViewButton($productId) {
    return '<a href="detail_product.php?id=' . $productId . '" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Xem nhanh</a>';
}

// Hàm hiển thị nút Thêm vào giỏ hàng
function showAddToCartButton($productId) {
    return '
            <button class="btn btn-sm text-dark p-0" onclick="AddCart('.$productId.')"><i class="fas fa-shopping-cart text-primary mr-1" ></i>Thêm vào giỏ hàng</button>
          ';
}
?>
