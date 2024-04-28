<div class="row">
    <div class="col-sm-12">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
            <thead>
                <tr role="row">
                    <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" style="width: 63.35px;">ID</th>
                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Tên nhà cung cấp</th>
                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Địa chỉ nhà cung cấp</th>
                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Email</th>
                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1">Số điện  thoại</th>
                    <th class="sorting" width="60px" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"></th>
                    <th class="sorting" width="60px" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'controller.php';

                $sanpham = new nhacungcap;
                $result = $sanpham->dsnhacc();

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>
                                            <td>' . $row['MaNCC'] . '</td>
                                            <td>' . $row['TenNCC'] . '</td>
                                            <td>' . $row['DiaChi'] . '</td>
                                            <td>' . $row['Email'] . '</td>
                                            <td>' . $row['SoDienThoai'] . '</td>
                                            <td><button class="btn btn-warning" onclick="suanhacc(' . $row['MaNCC'] . ')">Edit</button></td>
                                            <td><button class="btn btn-danger" onclick="xoanhacc(' . $row['MaNCC'] . ')">Delete</button></td>
                                        </tr>';
                }
                ?>

            </tbody>

        </table>

    </div>
    <div class="row">
        <div class="col-sm-12 col-md-7">
            <div class="dataTables_paginate paging_simple_numbers" id="pagination-button">
    
            </div>
        </div>
    </div>
</div>
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