<?php
// Include database connection parameters
require("connect_cuatui.php");


// Function to fetch products from the database
function fetchSanpham($conn) {
    $sql = "SELECT * FROM sanpham";
    $result = $conn->query($sql);
    if (!$result) {
        die("Lỗi truy vấn: " . $conn->error);
    }

    $sanpham = [];
    while ($row = $result->fetch_assoc()) {
        $sanpham[] = $row;
    }

    $result->close(); // Đóng kết quả

    return $sanpham;
}
function fetchSanphamDM($conn,$dk){
    $sql = "SELECT * FROM sanpham WHERE MaDM='".$dk."'";
    $result = $conn->query($sql);
    if (!$result) {
        die("Lỗi truy vấn: " . $conn->error);
    }

    $sanpham = [];
    while ($row = $result->fetch_assoc()) {
        $sanpham[] = $row;
    }

    $result->close(); // Đóng kết quả

    return $sanpham;
}

?>
