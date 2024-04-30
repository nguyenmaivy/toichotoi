<?php
require("sanpham.php");
require_once("product_actions.php");

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
if (isset($_REQUEST['data'])) {
    $data=$_REQUEST['data'];
    $data = json_decode($data);
    $sanpham =null;
    if (!$data->alldm) {
        $sanpham=[];
        foreach ($data->dm as $item) {
            $result = fetchSanphamDM($db->conn, $item);
            $spLocGia = filterSanphamByPrice($result, $data->price);
            $sanpham=array_merge($sanpham,$spLocGia);
        }
    } else {
        $sanpham=null;
        $sanpham = fetchSanpham($db->conn);
        $sanpham = filterSanphamByPrice($sanpham, $data->price);
    }
    // print_r($sanpham);
    

    foreach ($sanpham as $row) {
        echo '
        <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <img class="img-fluid w-100" src="./img/'.$row['HinhAnh'].'" alt="">
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <h6 class="text-truncate mb-3">'.$row['TenSP'].'</h6>
                    <div class="d-flex justify-content-center">
                        <h6>'.$row['GiaSP'].'</h6>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between bg-light border">
                    <!-- Nút Xem Nhanh -->
                    '.showQuickViewButton($row['MaSP']).'
                    <!-- Nút Thêm vào Giỏ Hàng -->
                    '.showAddToCartButton($row['MaSP']).'
                </div>
                </div>
                </div>
                                    
        ';
    }
}
?>
