<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="./fonts/fontawesome-free-6.5.2-web/fontawesome-free-6.5.2-web/css/all.min.css">

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
    <div class="slider">  
      <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="./image/image-banner4.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="./image/image_banner3.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="./image/image_banner5.jpg" class="d-block w-100" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
    <!-- about -->
    <section id="contact" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2>Liên Hệ</h2>
                <p>Hãy liên lạc với chúng tôi để biết thêm chi tiết</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form id="contactForm">
                        <div class="form-group">
                            <label for="name">Họ và Tên</label>
                            <input type="text" class="form-control" id="name" placeholder="Nhập họ và tên" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Số điện thoại</label>
                            <input type="text" class="form-control" id="sdt" placeholder="Nhập số điện thoại" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Nhập email" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Lời Nhắn</label>
                            <textarea class="form-control" id="message" rows="4" placeholder="Nhập lời nhắn" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Gửi</button>
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
    
</body>
</html>