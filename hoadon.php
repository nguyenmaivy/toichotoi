<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fonts/fontawesome-free-6.4.0-web/css/all.min.css">
    <!-- <link href="css/style.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/adpanel.css">
    <link rel="stylesheet" href="./fonts/themify-icons-font/themify-icons/themify-icons.css">
    <title>Hóa đơn</title>
    <style>
        #root {
            width:80%;
            margin-left: auto;
            margin-right: auto;
        }
        footer {
            page-break-after: always;
            position: fixed;
            bottom: 0;
            display: block;
            width: 100%;
            left: 0;
        }
        
    </style>
</head>
<body>
    <div id="root" ></div>
    
    <script script src="./js/vadidation.js"></script>
    <script src="./js/jquery.min.js"></script>
    </script>
    <script>
        var id=<?php echo $_GET['id'] ;?>;
        $("#root").load('./pages/module/xlinhoadon.php?id='+id,function(){
            $(".btn-loaddon").remove()
            $(".print-pdf").text("In hóa đơn")
            $(".print-pdf").click(function(){
                setTimeout(()=>{
                    window.print();
                },0)
                $(this).remove();
            })
        })
    </script>
</body>
</html>