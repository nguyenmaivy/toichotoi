<?php
// Hàm hiển thị nút Xem nhanh
function showQuickViewButton($productId) {
    return '<a href="shop.php?id=' . $productId . '" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Xem nhanh</a>';
}

// Hàm hiển thị nút Thêm vào giỏ hàng
function showAddToCartButton($productId) {
    return '<form method="POST" action="add_to_cart.php">
            <input type="hidden" name="product_id" value="' . $productId . '">
            <button type="submit" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Thêm vào giỏ hàng</button>
          </form>';
}
?>
