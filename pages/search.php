<?php 
require_once("product_actions.php");
include './module/sanpham.php';
    if(isset($_REQUEST['data'])){
        $data=$_REQUEST['data'];
        $result=$sanpham->timsanpham($data);
        if(mysqli_num_rows($result)==0){
            $result=$sanpham->sanpham($data);
        }
        $data="";
        if(mysqli_num_rows($result)>0){
            while($row=mysqli_fetch_assoc($result)){
                $data.='<form method="GET" action="">
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
                            </form>
                            ';
            }
        }
        else {
            echo "Không có sản phẩm nào";
        }
        echo $data;
    }
            