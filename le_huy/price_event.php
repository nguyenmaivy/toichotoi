<?php
require("sanpham.php");

function filterSanphamByPrice($sanpham, $selectedPrice) {
    $priceRanges = [
        'price-all' => [0, PHP_INT_MAX],
        'price-1' => [0, 100000],
        'price-2' => [101000, 200000],
        'price-3' => [201000, 300000],
        'price-4' => [301000, 400000],
        'price-5' => [401000, PHP_INT_MAX]
    ];

    $filteredSanpham = array_filter($sanpham, function($sp) use ($selectedPrice, $priceRanges) {
        $priceRange = $priceRanges[$selectedPrice];
        return intval($sp['GiaSP']) >= $priceRange[0] && intval($sp['GiaSP']) <= $priceRange[1];
    });

    return $filteredSanpham;
}

$db = new ConnectDB();
$sanpham = fetchSanpham($db->conn);

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['price'])) {
    $selectedPrice = $_GET['price'];
    $filteredSanpham = filterSanphamByPrice($sanpham, $selectedPrice);
    
    foreach ($filteredSanpham as $sp) {
        echo '<div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                <div class="card product-item border-0 mb-4">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid w-100" src="' . $sp['HinhAnh'] . '" alt="' . $sp['TenSP'] . '">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">' . $sp['TenSP'] . '</h6>
                        <div class="d-flex justify-content-center">
                            <h6>' . $sp['GiaSP'] . '</h6>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>Xem nhanh</a>
                        <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Thêm vào giỏ hàng</a>
                    </div>
                </div>
            </div>';
    }
}
?>
