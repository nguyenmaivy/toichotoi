<?php
require_once("sanpham.php");

// Khởi tạo kết nối
$db = new ConnectDB();

// Xử lý yêu cầu tìm kiếm
if(isset($_GET['search'])) {
    // Xử lý dữ liệu đầu vào từ người dùng để tránh tấn công SQL injection
    $search = $db->conn->real_escape_string($_GET['search']);
    
    // Thực hiện truy vấn
    if (is_numeric($search)) {
        // Nếu là số, tìm kiếm theo MASP
        $sql = "SELECT * FROM sanpham WHERE MASP = '$search'";
    } else {
        // Nếu không phải là số, tìm kiếm theo TenSP
        $sql = "SELECT * FROM sanpham WHERE TenSP LIKE '%$search%'";
    }
    $result = $db->conn->query($sql);

    // Kiểm tra kết quả của truy vấn
    if ($result) {
        if ($result->num_rows > 0) {
            // Hiển thị kết quả dưới dạng sản phẩm
            while($row = $result->fetch_assoc()) {
                echo "<div>";
                echo "<img src='" . $row["HinhAnh"] . "' alt='" . $row["TenSP"] . "'>";
                echo "<p>ID: " . $row["MaSP"]. "</p>";
                echo "<p>Name: " . $row["TenSP"]. "</p>";
                echo "<p>Price: " . $row["GiaSP"]. "</p>";
                echo "</div>";
            }
        } else {
            echo "No results found.";
        }
    } else {
        // Hiển thị thông báo lỗi nếu truy vấn không thành công
        echo "Query failed: " . $db->conn->error;
    }
}
?>
