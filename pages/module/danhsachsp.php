<head>
    <link rel="stylesheet" href="css/sb-admin-2.min.css">
    <link rel="stylesheet" href="css/dssp.css">


</head>
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
                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Trang thái</th>
                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Thương hiệu</th>
                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Danh mục</th>
                    <th class="sorting" width="60px" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"></th>
                    <th class="sorting" width="60px" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"></th>
                </tr>
            </thead>
            <!-- <tfoot>
                                        <tr>
                                            <th rowspan="1" colspan="1">Name</th>
                                            <th rowspan="1" colspan="1">Position</th>
                                            <th rowspan="1" colspan="1">Office</th>
                                            <th rowspan="1" colspan="1">Age</th>
                                            <th rowspan="1" colspan="1">Start date</th>
                                            <th rowspan="1" colspan="1">Salary</th>
                                        </tr>
                                    </tfoot> -->
            <!-- Phần thẻ thead và các thẻ th trong table -->
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
                                            <td>' . $row['TrangThai'] . '</td>
                                            <td>' . $row['TenTH'] . '</td>
                                            <td>' . $row['MaDM'] . '</td>
                                            <td><button class="btn btn-warning" onclick="suasanpham(' . $row['MaSP'] . ')">Edit</button></td>
                                            <td><button class="btn btn-danger" onclick="xoasanpham(' . $row['MaSP'] . ')">Delete</button></td>
                                        </tr>';
                }
                ?>

            </tbody>

        </table>
        <button>Add product</button>

    </div>
    <div class="row">
        <!-- <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">
                                        Showing 1 to 10 of 57 entries

                                    </div>
                                </div> -->
        <div class="col-sm-12 col-md-7">
            <div class="dataTables_paginate paging_simple_numbers" id="pagination-button">
                <!-- <ul class="pagination">
                    <li class="paginate_button page-item previous disabled" id="dataTable_previous"> 
                        <a href="#" aria-controls="dataTable" data-dt-idx="0" tabindex="0" class="page-link">
                            Previous
                        </a>
                    </li>
                    <li class="paginate_button page-item active">
                        <a href="#" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link">
                            1
                        </a>
                    </li>
                    <li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                    <li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                    <li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
                    <li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
                    <li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
                    <li class="paginate_button page-item next" id="dataTable_next"><a href="#" aria-controls="dataTable" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li>
                </ul> -->
            </div>
        </div>
    </div>
</div>
<script src="js/pagination.js"></script>
<script type="text/javascript">
    (function(name) {
        var container = 
        $('#pagination-' + name);
        console.log(container);
        if (!container.length) return;
        var sources = function() {
            var result = [];

            for (var i = 1; i < 5; i++) {
                result.push(i);
            }

            return result;
        }();

        var options = {
            dataSource: sources,
            callback: function(response, pagination) {
                window.console && console.log(response, pagination);

                var dataHtml = '<ul class="pagination">';

                $.each(response, function(index, item) {
                    dataHtml += '<li class="pagination-chill">' + item + '</li>';
                });

                dataHtml += '</ul>';

                container.prev().html(dataHtml);
            }
        };

        //$.pagination(container, options);

        container.addHook('beforeInit', function() {
            window.console && console.log('beforeInit...');
        });
        container.pagination(options);

        container.addHook('beforePageOnClick', function() {
            window.console && console.log('beforePageOnClick...');
            //return false
        });
    })('button');
</script>
<script>
    $(".btn-closee").click(function() {
        $(".btn-login").addClass("btn-default")
    })
    $("input").on("input", function() {
        $(".error-login").css("display", "none")
    })
</script>
<script>
    (function(name) {
        var container = $('#pagination-' + name);
        if (!container.length) return;
        var sources = function() {
            var result = [];

            for (var i = 1; i < 196; i++) {
                result.push(i);
            }

            return result;
        }();

        var options = {
            dataSource: sources,
            callback: function(response, pagination) {
                window.console && console.log(response, pagination);

                var dataHtml = '<ul>';

                $.each(response, function(index, item) {
                    dataHtml += '<li>' + item + '</li>';
                });

                dataHtml += '</ul>';

                container.prev().html(dataHtml);
            }
        };

        //$.pagination(container, options);

        container.addHook('beforeInit', function() {
            window.console && console.log('beforeInit...');
        });
        container.pagination(options);

        container.addHook('beforePageOnClick', function() {
            window.console && console.log('beforePageOnClick...');
            //return false
        });
    })('demo1');
</script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->