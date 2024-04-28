document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("registerForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Ngăn chặn gửi biểu mẫu mặc định

        // Lấy dữ liệu biểu mẫu
        var formData = new FormData(this);

        // Gửi yêu cầu AJAX
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Hiển thị kết quả từ server
                    var response = xhr.responseText;
                    alert(response); // Hiển thị thông báo alert với kết quả từ server
                } else {
                    console.error('Lỗi:', xhr.statusText);
                }
            }
        };
        xhr.open('POST', 'your_php_file.php', true);
        xhr.send(formData);
    });

    // Thêm sự kiện AJAX cho biểu mẫu đăng nhập ở đây nếu cần
});