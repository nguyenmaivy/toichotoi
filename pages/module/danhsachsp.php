<div class="row">
    <div class="col-sm-12">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
            <thead>
                <tr role="row">
                    <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" style="width: 63.35px;">ID</th>
                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Tên sản phẩm</th>
                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Ảnh sản phẩm</th>
                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Số lượng sản phẩm</th>
                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Giá sản phẩm</th>
                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Thương hiệu</th>
                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Danh mục</th>
                    <th class="sorting" width="60px" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'controller.php';

                $sanpham = new sanpham;
                $result = $sanpham->danhsachsp();

                while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>
                            <td>' . $row['MaSP'] . '</td>
                            <td>' . $row['TenSP'] . '</td>
                            <td><img src="./img/' . $row['HinhAnh'] . '" class="img-sanpham"></td>
                            <td>' . $row['SoLuongSP'] . '</td>
                            <td>' . $row['GiaSP'] . '</td>
                            <td>' . $row['TenTH'] . '</td>
                            <td>' . $row['TenDanhMuc'] . '</td>
                            <td><button class="btn btn-danger" onclick="xoasanpham(' . $row['MaSP'] . ',' . $row['SoLuongSP'] . ')">Delete</button></td>
                        </tr>';
                }
                ?>

            </tbody>

        </table>

    </div>
    <div class="row">
        <div class="col-sm-12 col-md-7">
        </div>
    </div>
</div>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->