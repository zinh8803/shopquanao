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
    <section id="pricing" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2>Giá Cả</h2>
                <p>Chọn gói phù hợp với nhu cầu của bạn</p>
            </div>
            <div class="row">
                <!-- Plan 1 -->
                <div class="col-md-4 cart_1">
                    <div class="card mb-4">
                        <div class="card-header text-center">
                            <h4>Dịch vụ 1</h4>
                            <p class="h1">700,000đ</p>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li>5 sản phẩm</li>
                                <li>Miễn phí giao hàng</li>
                                <li>Hỗ trợ 24/7</li>
                            </ul>
                            <a href="#formfri" class="btn btn-primary btn-block">Chọn Gói</a>
                        </div>
                    </div>
                </div>
                <!-- Plan 2 -->
                <div class="col-md-4 cart_2" >
                    <div class="card mb-4">
                        <div class="card-header text-center">
                            <h4>Dịch vụ 2</h4>
                            <p class="h1">1,200,000đ</p>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li>10 sản phẩm</li>
                                <li>Miễn phí giao hàng</li>
                                <li>Hỗ trợ 24/7</li>
                                <li>Giảm giá 10% cho đơn hàng tiếp theo</li>
                            </ul>
                            <a href="#formfri" class="btn btn-primary btn-block">Chọn Gói</a>
                        </div>
                    </div>
                </div>
                <!-- Plan 3 -->
                <div class="col-md-4 cart_3">
                    <div class="card mb-4">
                        <div class="card-header text-center">
                            <h4>Dịch vụ 3</h4>
                            <p class="h1">2,500,000đ</p>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li>20 sản phẩm</li>
                                <li>Miễn phí giao hàng</li>
                                <li>Hỗ trợ 24/7</li>
                                <li>Giảm giá 20% cho đơn hàng tiếp theo</li>
                                <li>Thẻ thành viên VIP</li>
                            </ul>
                            <a href="#formfri" class="btn btn-primary btn-block">Chọn Gói</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="formfricing" id="formfri"> 
            <form id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header title_pri">
                      <h4 class="modal-title" id="myModalLabel">Điền Thông Tin</h4>
                     
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label for="name">Họ Tên</label>
                        <input type="text" class="form-control" id="name" placeholder="Nhập Họ Tên">
                      </div>
                      <div class="form-group">
                        <label for="phone">Số Điện Thoại</label>
                        <input type="text" class="form-control" id="phone" placeholder="Nhập Số Điện Thoại">
                      </div>
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Nhập Email">
                      </div>
                      <div class="form-group">
                        <label for="services">Chọn Dịch Vụ</label>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="service1">
                          <label class="form-check-label" for="service1">
                            Dịch Vụ 1
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="service2">
                          <label class="form-check-label" for="service2">
                            Dịch Vụ 2
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="service3">
                          <label class="form-check-label" for="service3">
                            Dịch Vụ 3
                          </label>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="other">Yêu Cầu Khác</label>
                        <textarea class="form-control" id="other" rows="3" placeholder="Nhập Yêu Cầu Khác"></textarea>
                      </div>
                      <a type="submit" class="btn_pricing btn btn-primary">Gửi</a>
                      
                    </div>
                  </div>
                </div>
              </form>
            
        </div>
        
    </section>

      
  </div>
</div>
</div>

    <!-- footer -->
    <div class="footer " >
      <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                  <h6>Liên hệ</h6>
                    <ul>
                        <li><i class="fa-solid fa-location-dot"></i> 180 Cao Lỗ Phường 4 Quận 8 Tp.HCM</li>
                        <li><i class="fa-solid fa-mobile"></i> Phone : 0799117548</li>
                        
                    </ul>
                  
                    
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                <div class="footer__widget">
                    <h6>
                        Yêu cầu hỗ trợ</h6>
                    <ul>
                        <li><a href="#">Về chúng tôi</a></li>
                        <li><a href="#">Về cửa hàng chúng tôi</a></li>
                        <li><a href="#">Mua sắm an toàn</a></li>
                        <li><a href="#">Thông tin giao dịch</a></li>
                        <li><a href="#">Bảo mật</a></li>
                        <li><a href="#">Hồ sơ trang web</a></li>
                    </ul>
                    <ul>
                        <li><a href="#">Chúng tôi là ai?</a></li>
                        <li><a href="#">Dịch vụ của chúng tôi</a></li>
                        <li><a href="#">Dự án</a></li>
                        <li><a href="#">Liên hệ</a></li>
                        <li><a href="#">Sự thay đổi</a></li>
                        <li><a href="#">Lời cảm ơn</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-9">
                <div class="footer__widget">
                    <h6>Trở thành thành viên của chúng tôi ngay bây giờ</h6>
                    <p>Nhận thông tin cập nhật qua E-mail về cửa hàng mới nhất của chúng tôi và các ưu đãi đặc biệt.</p>
                    <form class="d-flex">
                        <input class=" px-2 search" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn0 " type="submit">Search</button>
                      </form>
                    
                </div>
            </div>
       
       
    </div>
    </div>
    <script src="./js/bootstrap.bundle.js"></script>
    <script src="./js/main.js"></script>
    
</body>
</html>