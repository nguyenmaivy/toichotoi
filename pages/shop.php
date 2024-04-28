


<div class="container-fluid">
        <div class="row bg-secondary py-2 px-xl-5">
            <!-- Topbar content -->
        </div>
        <div class="row align-items-center py-3 px-xl-5">
            <!-- More topbar content -->
        </div>
    </div>
    <div class="container-fluid">
        <div class="row border-top px-xl-5">
            <!-- Navbar content -->
        </div>
    </div>
    <div class="container-fluid bg-secondary mb-5">
        <!-- Page header content -->
    </div>
   

<!-- Page Header Start -->
<!-- <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Tất cả sản phẩm</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Trang chủ</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Sản phẩm</p>
            </div>
        </div>
    </div> -->
    <!-- Page Header End -->
    <!-- Shop Start -->

    <div class="container-fluid">
        <div class="row pb-3">
            <!-- Product search form -->
                
                
                
            
            </div>
            
                
            
            </div>
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-3 col-md-12">
                <?php require("price.php") ?>
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Thương hiệu</h5>
                    <!-- tự làm tiếp nhé -->
                </div>
                <div class="mb-5">
                    <h5 class="font-weight-semi-bold mb-4">Size</h5>
                    <form>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="size-all">
                            <label class="custom-control-label" for="size-all">All Size</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-1">
                            <label class="custom-control-label" for="size-1">Fullsize</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-2">
                            <label class="custom-control-label" for="size-2">Minisize</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-3">
                            <label class="custom-control-label" for="size-3">Combo</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>

                    </form>
                </div>
                </div>
            <!-- Product search form -->
                 
                <!-- Price End -->

                <!-- Color Start -->
                
                <!-- Color End -->

                <!-- Size Start -->
                
                <!-- Size End -->
        
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
                <div class="col-lg-9 col-md-12">
                    <div class="row pb-3">
                        <div class="col-12 pb-1">
                            <?php require_once("search_form.php"); ?>
                        </div>
                        <div class="product-detail" id="productDetailContainer">
                            <?php require("product_start.php"); ?>
                        </div>
                    </div>
                </div>
            </div>
            </div> 
        </div>
        <!-- Shop Product End -->
    </div>
    <div class="page-nav">
        <ul class="page-nav-list"></ul>
    </div>
<!-- Shop End -->
</main>
 <div class="modal product-detail">
            <button class="modal-close close-popup"><i class="fa-thin fa-xmark">X</i></button>
            <div class="modal-container mdl-cnt" id="product-detail-content">
            </div>
        </div>



   