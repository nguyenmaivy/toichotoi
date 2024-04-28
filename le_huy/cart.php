<?php
session_start(); // Bắt đầu phiên làm việc nếu chưa được bắt đầu

// Kiểm tra nếu biến phiên 'cart' tồn tại, nếu không, khởi tạo nó là một mảng rỗng
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Kiểm tra nếu nút 'addcart' được nhấn
if (isset($_POST['addcart'])) {
    // Tạo một mảng để lưu trữ chi tiết sản phẩm
    $product = array(
        'MaSP' => $_POST['MaSP'],
        'HinhAnh' => $_POST['HinhAnh'],
        'TenSP' => $_POST['TenSP'],
        'GiaSP' => $_POST['GiaSP']
    );

    // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
    $found = false;
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['MaSP'] === $product['MaSP']) {
            // Nếu tìm thấy, tăng số lượng và cập nhật giỏ hàng
            $_SESSION['cart'][$key]['SoLuong'] += 1;
            $found = true;
            break;
        }
    }

    // Nếu không tìm thấy, thêm sản phẩm vào giỏ hàng
    if (!$found) {
        $product['SoLuong'] = 1; // Khởi tạo số lượng
        $_SESSION['cart'][] = $product;
    }
}

// Kiểm tra nếu nút 'remove' được nhấn
if (isset($_POST['remove'])) {
    // Lấy chỉ mục của mục cần xóa
    $index = $_POST['index'];
    // Xóa mục khỏi biến phiên 'cart'
    unset($_SESSION['cart'][$index]);
    // Đặt lại các khóa mảng để duy trì tính liên tục
    $_SESSION['cart'] = array_values($_SESSION['cart']);
}

// Kiểm tra nếu nút 'update' được nhấn
if (isset($_POST['update'])) {
    // Lấy chỉ mục của mục cần cập nhật
    $index = $_POST['index'];
    // Cập nhật số lượng của mục trong giỏ hàng
    $quantity = $_POST['quantity'];
    if ($quantity > 0 && $quantity <= 10) {
        $_SESSION['cart'][$index]['SoLuong'] = $quantity;
    } else {
        // Nếu số lượng không hợp lệ, bạn có thể xử lý nó tương ứng.
        // Ví dụ, bạn có thể đặt một số lượng mặc định hoặc xóa mục khỏi giỏ hàng.
        // Ở đây, chúng tôi sẽ xóa mục vì tính đơn giản.
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}

// Hiển thị các mục trong giỏ hàng
foreach ($_SESSION['cart'] as $index => $item) {
    echo "<div>";
    if (isset($item['HinhAnh'])) {
        echo "<img src='./img/" . htmlspecialchars($item['HinhAnh']) . "' alt='" . htmlspecialchars($item['TenSP']) . "'>";
    } else {
        echo "<p>Ảnh không có sẵn</p>";
    }
    if (isset($item['TenSP'])) {
        echo "<h3>" . htmlspecialchars($item['TenSP']) . "</h3>";
    } else {
        echo "<p>Tên sản phẩm không có sẵn</p>";
    }
    if (isset($item['GiaSP'])) {
        echo "<p>Giá: " . htmlspecialchars($item['GiaSP']) . "</p>";
    } else {
        echo "<p>Giá không có sẵn</p>";
    }
    // Biểu mẫu để điều chỉnh số lượng và xóa mục
    echo "<form method='POST'>";
    echo "<input type='hidden' name='index' value='$index'>";
    if (isset($item['SoLuong'])) {
        echo "Số lượng: <input type='number' name='quantity' value='" . htmlspecialchars($item['SoLuong']) . "' min='1' max='10'>      "; // Trường nhập số lượng
    } else {
        echo "<p>Số lượng không có sẵn</p>";
    }
    echo "<button type='submit' name='update'>Cập nhật</button>"; // Nút Cập nhật
    echo "<br>"; // Thêm xuống hàng ở đây
    echo "Xóa sản phẩm: <button type='submit' name='remove'>Xóa</button>"; // Nút Xóa
    echo "</form>";
    echo "</div>";
}
?>
