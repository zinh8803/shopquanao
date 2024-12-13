<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="./fonts/fontawesome-free-6.5.2-web/fontawesome-free-6.5.2-web/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="preconnect" href="https://fonts.gstatic.com">    
    <title>Trang Chủ</title>
</head>
<body>
    <!-- menu -->
    <?php 
    session_start();
 include("web/header.php");
 ?>


    <!-- noi dung chinh -->
<div class="content">
<div class="container">
    <!-- banner -->
    <?php 
  
 include("web/banner.php");
 ?>
    <!-- about -->
    <section id="contact" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2>Liên Hệ</h2>
                <p>Hãy liên lạc với chúng tôi để biết thêm chi tiết</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                <form id="contactForm" class="p-4 border rounded shadow">
        <div class="mb-3">
            <label for="name" class="form-label">Họ và Tên</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ và tên" required>
        </div>
        <div class="mb-3">
            <label for="sdt" class="form-label">Số điện thoại</label>
            <input type="text" class="form-control" id="sdt" name="sdt" placeholder="Nhập số điện thoại" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" required>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Lời Nhắn</label>
            <textarea class="form-control" id="message" name="message" rows="4" placeholder="Nhập lời nhắn" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-100">Gửi</button>
    </form>
                </div>
            </div>
        </div>
    </section>
    </div>
      
  </div>
</div>
</div>

    <!-- footer -->
    <?php 
  
 include("web/footer.php");
 ?>
    <script src="./js/bootstrap.bundle.js"></script>
<script>
    $(document).ready(function () {
        $('#contactForm').on('submit', function (e) {
            e.preventDefault();

            // Thu thập dữ liệu từ form
            const formData = {
                name: $('#name').val().trim(),
                sdt: $('#sdt').val().trim(),
                email: $('#email').val().trim(),
                message: $('#message').val().trim()
            };

            // Kiểm tra dữ liệu
            if (!formData.name || !formData.sdt || !formData.email || !formData.message) {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Vui lòng điền đầy đủ thông tin!'
                });
                return;
            }

            // Gửi dữ liệu qua AJAX
            $.ajax({
                url: 'function/process_contact.php',
                type: 'POST',
                data: formData,
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công!',
                        text: 'Thông tin đã được gửi. Chúng tôi sẽ liên hệ sớm nhất.'
                    });
                    $('#contactForm')[0].reset(); 
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi',
                        text: 'Có lỗi xảy ra khi gửi thông tin. Vui lòng thử lại sau!'
                    });
                }
            });
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>