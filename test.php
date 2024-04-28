<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="col-md-12">
            <form id="submit_form" action="ajax_action.php" method="POST">
                <div class="form-group">
                    <label>Chọn ảnh</label>
                    <input type="file" name="file" id="image_file">
                    <span class="help-block">Cho phép file ȧnh jpg, jpeg, png, gif</span>
                </div>
                <input type="submit" name="upload_button" class="btn btn-info" value="Upload" />
            </form>
            <br />
            <h3 align="center">Xem trước ȧnh</h3>
            <div id="image_preview">
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#submit_form').on('submit',function(e){
                e.preventDefault();
                $.ajax({
                    url:"ajax_action.php",
                    method:'POST',
                    data:new FormData(this),
                    contentType:false,
                    processData: false,
                    success:function(data)
                    {
                        $('#image_preview').html(data);
                        $('#image_file').val('');
                    }
                });
            });
            
        });
    </script>

</body>

</html>