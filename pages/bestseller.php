<div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Sản phẩm bán chạy</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
            <?php 
                include './pages/module/controller.php';
                include 'product_actions.php';
                $sanpham=new sanpham;
                $result=$sanpham->dssanpham();
                $num=mysqli_num_rows($result);
                $data="";
                for($i=0;$i<8;$i++){
                    $int=random_int(0,$num-1);
                    mysqli_data_seek($result,$int);
                    $row=mysqli_fetch_assoc($result);
                    $data.="<div class='col-lg-3 col-md-6 col-sm-12 pb-1'>
                    <div class='card product-item border-0 mb-4'>
                        <div class='card-header product-img position-relative overflow-hidden bg-transparent border p-0'>
                            <img class='img-fluid w-100' src='./img/".$row['HinhAnh']."' alt=''>
                        </div>
                        <div class='card-body border-left border-right text-center p-0 pt-4 pb-3'>
                            <h6 class='text-truncate mb-3'>".$row['TenSP']."</h6>
                            <div class='d-flex justify-content-center'>
                                <h6>123.00</h6>
                                <h6 class='text-muted ml-2'><del>".$row['GiaSP']."</del></h6>
                            </div>
                        </div>
                        <div class='card-footer d-flex justify-content-between bg-light border'>
                        ".showQuickViewButton($row['MaSP']).showAddToCartButton($row['MaSP'])."
                        </div>
                        </div>
                    </div>";
                }
                echo $data;
            ?>
        </div>
    </div>