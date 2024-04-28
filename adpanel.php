<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./fonts/themify-icons-font/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="fonts/fontawesome-free-6.4.0-web/css/all.min.css">
    <!-- <link href="css/style.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/adpanel.css">
    <link rel="stylesheet" href="./fonts/themify-icons-font/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="css/styleAdmin.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.4/css/dataTables.bootstrap5.css">
    
    <title>Document</title>
</head>
<body>
    <div id="rapper-admin">
        <div id="header">
            <div class="container-item"><i class="ti-layout-grid2-alt"></i> Administrator</div>
            <div class="container-item" onclick="cook()"><i class="ti-share-alt"></i> Vào trang web</div>
            <div class="container-item right-item">Xin chào: admin <i class="ti-angle-down"></i></div>
        </div>
        <div id="content">
            <div class="left-content">
                <div class="container active" id="cmm">
                    <i class="ti-home"></i>
                    Trang chủ Admin
                </div>
                <div class="container">
                    <div class="item-container" id="qlkho">
                        Quản lý Kho <i class="ti-angle-down"></i>
                    </div>
                    <ul class="menudrop-qlkho">
                        <li class="item-menu"><i class="ti-plus"></i> Quản lý sản phẩm </li>
                        <li class="item-menu"><i class="ti-plus"></i> Quản lý nhà cung cấp</li>
                        <li class="item-menu"><i class="ti-plus"></i> Tìm kiếm sản phẩm</li>
                        <li class="item-menu"><i class="ti-plus"></i> Lập phiếu nhập kho</li>
                        <li class="item-menu"><i class="ti-plus"></i> Thống kê lịch sử nhập</li>
                    </ul>

                </div>
                <div class="container">
                    <div class="item-container" id="banhang">
                        Quản lý Bán Hàng <i class="ti-angle-down"></i>
                    </div>
                    <ul class="menudrop-banhang">
                        <li class="item-menu"><i class="ti-plus"></i> Quản lý tài khoản </li>
                        <li class="item-menu"><i class="ti-plus"></i> Đơn hàng</li>
                        <li class="item-menu"><i class="ti-plus"></i> Xem thống kê bán hàng</li>
                    </ul>

                </div>
            </div>
            <div id="right-content">
                <div class="model-tk model-right">
                    <div class="top-menu">
                    <ul class="list-group list-group-horizontal menu-container">
                        <li class="list-group-item model-item">Thêm tài khoản</li>
                        <li class="list-group-item model-item">Sửa tài khoản</li>
                        <li class="list-group-item model-item">Xóa tài khoản</li>
                    </ul>
                    </div>
                    
                    <div class="model-content">
                    </div>
                </div>
                <div class="model-duyetdon model-right">
                    <div class="top-menu">
                    <ul class="list-group list-group-horizontal menu-container">
                        <li class="list-group-item model-item">Danh sách đơn hàng</li>
                        <li class="list-group-item model-item">Lọc danh sách đơn hàng chưa duyệt</li>
                    </ul>
                    </div>
                    <div class="model-content-hd">
                    </div>
                </div>
                <div class="model-thongke model-right">
                    <div class="top-menu">
                    <ul class="list-group list-group-horizontal menu-container">
                        <li class="list-group-item model-item">Báo cáo hôm nay</li>
                        <li class="list-group-item model-item">Báo cáo theo khoảng thời gian</li>
                    </ul>
                    </div>
                    <div class="model-content-tkbh mt-5">
                    </div>
                </div>
                <div class="model-qlkho model-right">
                   
                </div>
                <div class="model-thongkenhap model-right">
                   
                </div>
                <!-- <div class="model-in model-right">
                    <div class="top-menu">
                    <ul class="list-group list-group-horizontal menu-container">
                    <li class="list-group-item model-item active">Hóa đơn bán hàng</li>
                    </ul>
                    </div>
                    <div class="model-content">
                    </div>
                </div> -->
                <!-- <div class="content-doanhthu">
                    <p>báo cáo doanh thu</p>
                    <label for="1">từ ngày</label>
                    <input type="date" name="1" id="from-date"> 
                    <label for="2">đến ngày</label>
                    <input type="date" id="to-date">
                    <button onclick="showdate()">xx</button>
                    <div class="header-right-content top-menu">
                        <div class="id-kh">id khach hàng</div>
                        <div class="ten-sp">Tên Sản Phẩm</div>
                        <div class="so-luong">Số Lượng</div>
                        <div class="gia-sp">Đơn giá</div>
                        <div class="gia-sp">Thành tiền</div>
                    </div>
                  </div> -->
            </div>
        </div>
    </div>
    <!-- <div class="modal-add-product">
        <div class="container-modal">
            <form action="" id="testt">
                <div class="item-modal">
                    <p class="left-modal">Thể loại</p>
                    <select name="" class="right-modal" id="select-category" onchange="Preview()">
                        <option value="vanhoc">Văn học</option>
                        <option value="amthuc-nauan">Ẩm thực</option>
                        <option value="yhoc-suckhoe">Sức khỏe</option>
                        <option value="kientruc-xaydung">Kiến trúc</option>
                        <option value="kinhte">Kinh tế</option>
                        <option value="ngoaingu">Ngoại ngữ</option>
                        <option value="phapluat">Pháp luật</option>
                    </select>
                </div>
                <div class="item-modal">
                    <p class="left-modal">Hình ảnh</p>
                    <input type="file" class="right-modal" onchange="Preview()" id="inputfile">
                </div>
                <div class="item-modal">
                    <p class="left-modal">Tên sản phẩm</p>
                    <input type="text" placeholder="Nhập tên" class="right-modal" id="product-name-js" onchange="Preview()">
                </div>
                <div class="item-modal">
                    <p class="left-modal">Số lượng sản phẩm</p>
                    <input type="text" placeholder="Nhập số lượng" class="right-modal" id="product-sl-js" onchange="Preview()">
                </div>
                <div class="item-modal">
                    <p class="left-modal">Giá tiền</p>
                    <input type="text" placeholder="Giá Thành VNĐ" class="right-modal" id="product-price-js" onchange="Preview()">
                </div>
                <div class="item-modal">
                    <p class="left-modal">Giới thiệu sản phẩm</p>
                    <textarea name="" cols="30" rows="10" class="right-modal" id="product-details-js" onchange="Preview()"></textarea>
                </div>
                <div class="item-modal button-add-product" id="getShowBtn">
                </div>
                <div class="show-product container-content" id="show-product-tmp"></div>
            </div>
        </form>

    </div> -->
    <?php 
        include './pages/footer.php';
    ?>
    <script src="./js/vadidation.js"></script>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.4/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.4/js/dataTables.bootstrap5.js"></script>
    <script src="./js/adpanel.js"></script>
    
</body>
</html>