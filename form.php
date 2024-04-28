<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/form.css">
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form name="form" method="post" action="pages/xuly.php">
                <h1>Tạo tài khoản</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>hoặc sử dụng thông tin của bạn để đăng kí</span>
                <input type="text" name="userName" placeholder="Tên đăng nhập">
                <input type="phone" name="soDienThoai" placeholder="Số điện thoại">
                <input type="password" name="matKhau" placeholder="Mật khẩu">
                <button type="submit" name="dangki" >Đăng ký</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form method="post" action="pages/xuly.php">
                <h1>Đăng nhập</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>hoặc sử dụng tên đăng nhập và mật khẩu của bạn</span>
                <input type="phone" name="soDienThoai" placeholder="Số điện thoại">
                <input type="password" name="matKhau" placeholder="Mật khẩu">
                <a href="#">Quên mật khẩu?</a>
                <button type="submit" name="dangnhap" >Đăng nhập</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Chào mừng bạn</h1>
                    <p>Nhập thông tin cá nhân để sử dụng những tính năng của trang web</p>
                    <button class="hidden" id="login">Đăng nhập</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Xin chào !</h1>
                    <p>Hãy đăng kí với thông tin cá nhân của bạn để sử dụng những tính năng của trang web</p>
                    <button class="hidden" id="register">Đăng kí</button>
                </div>
            </div>
        </div>
    </div>

    <script src="js/form.js"></script>
    <script src="./js/jquery.min.js"></script>
</body>

</html>