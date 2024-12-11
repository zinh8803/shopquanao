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
session_start(); // Bắt đầu session


?>

 <?php 
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
    <div class="about" id="about">
      <div class="row">
        <div class="col-md-8">
            <h2>Về Công Ty</h2>
             <p>Được thành lập vào năm 2010, YaMe (viết tắt của "You are My Everything") bắt đầu từ một cửa hàng thời trang nhỏ nằm sâu trong lòng Quận 10, TP. Hồ Chí Minh. Với sứ mệnh mang đến phong cách thời trang độc đáo và đa dạng cho giới trẻ Việt Nam, YaMe đã không ngừng phát triển và mở rộng mạng lưới cửa hàng của mình. </p>
             <h3>Phát triển và mở rộng</h3>
              <p>Đến nay, YaMe đã có mặt ở khắp các quận huyện TP. Hồ Chí Minh và các tỉnh thành Miền Tây, Đông Nam Bộ, Tây Nguyên với 42 cửa hàng.Từ cửa hàng nhỏ ban đầu, YaMe đã không ngừng nỗ lực và sáng tạo để đáp ứng nhu cầu thời trang ngày càng cao của khách hàng. Đến nay, YaMe đã có mặt khắp các quận huyện TP. Hồ Chí Minh và mở rộng ra các tỉnh thành Miền Tây, Đông Nam Bộ và Tây Nguyên với tổng cộng 42 cửa hàng. Sự phát triển này là minh chứng cho chất lượng sản phẩm và dịch vụ mà YaMe mang đến cho khách hàng. </p>
              <h3>Tri ân khách hàng</h3>
              <p>YaMe luôn biết ơn và trân trọng sự yêu thương, ủng hộ của khách hàng trong suốt quá trình phát triển. Thật tự hào khi YaMe được gắn bó với nhiều thế hệ khách hàng, từ thời học sinh, sinh viên cho đến khi trưởng thành và đi làm. Sự tin tưởng và ủng hộ của khách hàng chính là động lực to lớn để YaMe không ngừng hoàn thiện và phát triển.</p>
 
           
        </div>
        <div class="col-md-4 about_last">
            <img src="./image/image_about.jpg" alt="Image" class="img-fluid">
            <img src="./image/image_about2.jpg" alt="Image" class="img-fluid">
        </div>
        <div class="row">
          <div class="title_ab1">
            <h2> GẦN GŨI VÀ THÂN THIỆN </h2>
          </div>
         
          <div class="col-md-4">
            <div class="about_1 py-2">
              <div class="row d-flex justify-content-around">
                  <div class="about_con  mt-3 " >
                      <img src="./image/image_about2.jpg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="about-title">GIÁ CẢ DỄ TIẾP CẬN</h5>
                        <p class="about-text">Đa dạng “Giá thành” sản phẩm từ bình dân đến cao cấp, phù hợp với đại đa số. <b>Chỉ từ 78.000đ.</b></p>
                      </div>
            </div>
          </div>
        </div>
        </div>
          <div class="col-md-4">
            <div class="about_1 py-2">
              <div class="row d-flex justify-content-around">
                  <div class="about_con  mt-3 " >
                      <img src="./image/image_about1.jpg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="about-title">HỆ THỐNG CỬA HÀNG RỘNG KHẮP CẢ NƯỚC</h5>
                        <p class="about-text"> <b>Với 42 cửa hàng</b> có mặt ở TP.HCM và các tỉnh thành khác, thuận tiện cho khách hàng đến mua sắm.</p>
                      </div>
            </div>
          </div>
        </div>
            
          </div>
          <div class="col-md-4">
            <div class="about_1 py-2">
              <div class="row d-flex justify-content-around">
                  <div class="about_con  mt-3 " >
                      <img src="./image/image_about.jpg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="about-title">MUA SẮM THOẢI MÁI NHƯ SIÊU THỊ</h5>
                        <p class="about-text">Mua sắm thoải mái, <b>không người giám sát</b>, đa dạng sản phẩm. Đến YaMe mua quần áo như đi siêu thị.</p>
                      </div>
            </div>
          </div>
        </div>
            
          </div>
        </div>

        <div class="row">
          <div class="title_ab1">
            <h2> TẠO LẬP GIÁ TRỊ BỀN VỮNG </h2>
          </div>
         
          <div class="col-md-4">
            <div class="about_1 py-2">
              <div class="row d-flex justify-content-around">
                  <div class="about_con  mt-3 " >
                      <img src="./image/image_about4.jpg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="about-title">BỀN BỈ</h5>
                        <p class="about-text">Sản phẩm thời trang của YaMe bền bỉ theo thời gian về cả 2 mặt: “thiết kế” và “chất liệu”.</p>
                        <p><b>Thiết kế</b> đơn giản, tinh tế trong từng chi tiết, không lỗi mốt và dễ dàng phối đồ. <b>Chất liệu</b> bền màu, giữ được form dáng, không co rút sau nhiều lần giặt.</p>
                      </div>
            </div>
          </div>
        </div>
        </div>
          <div class="col-md-4">
            <div class="about_1 py-2">
              <div class="row d-flex justify-content-around">
                  <div class="about_con  mt-3 " >
                      <img src="./image/image_about5.jpg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="about-title">CHẤT LIỆU TỰ NHIÊN</h5>
                        <p class="about-text">YaMe luôn cải tiến chất liệu để mang đến những sản phẩm thời trang <b>thân thiện với môi trường</b> và an toàn khi sử dụng lâu dài.</p>
                        <p><b>Các chất liệu tự nhiên</b> như: Cotton Organic, Bamboo Fabric, Coffee Fabric, Modal Fabric, Rose Fabric.</p>
                      </div>
            </div>
          </div>
        </div>
            
          </div>
          <div class="col-md-4">
            <div class="about_1 py-2">
              <div class="row d-flex justify-content-around">
                  <div class="about_con  mt-3 " >
                      <img src="./image/image_about6.jpg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="about-title">CHẤT LƯỢNG XỊN TRONG TẦM GIÁ</h5>
                        <p class="about-text">Với mong muốn đem đến trải nghiệm hài lòng cho mọi khách hàng, các sản phẩm của YaMe với giá bình dân luôn có chất lượng ở mức ổn.</p>
                        <p>Còn với những sản phẩm có mức giá trung cấp thì <b>mềm, mịn, mát đến bất ngờ.</b></p>
                      </div>
            </div>
          </div>
        </div>
            
          </div>
        </div>


        <div class="row">
          <div class="title_ab1">
            <h2> PHÙ HỢP VỚI MỌI NHU CẦU</h2>
          </div>
         
          <div class="col-md-4">
            <div class="about_1 py-2">
              <div class="row d-flex justify-content-around">
                  <div class="about_con  mt-3 " >
                      <img src="./image/image_about7.jpg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="about-title">HOẠT ĐỘNG HÀNG NGÀY</h5>
                        <p class="about-text">Phong cách thời trang <b>đơn giản, tinh tế</b> trong hoạt động hàng ngày: đi làm, đi học, đi chơi, kể cả mặc nhà.</p>
                        <p>Chọn ngay Bộ sưu tập <b>Seventy Seven “7.7”, Premium, NoStyle.</b></p>
                      </div>
            </div>
          </div>
        </div>
        </div>
          <div class="col-md-4">
            <div class="about_1 py-2">
              <div class="row d-flex justify-content-around">
                  <div class="about_con  mt-3 " >
                      <img src="./image/image_about8.jpg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="about-title">HOẠT ĐỘNG THỂ THAO</h5>
                        <p class="about-text">Phương pháp may hỗ trợ thể thao giúp <b>thoát nhiệt nhanh,co giãn theo từng chuyển động,</b>  phù hợp nhiều môn thể thao.</p>
                        <p>Bắt đầu thể dục, chỉ từ<b> 78.000đ</b> với Bộ sưu tập <b>Beginner.</b></p>
                      </div>
            </div>
          </div>
        </div>
            
          </div>
          <div class="col-md-4">
            <div class="about_1 py-2">
              <div class="row d-flex justify-content-around">
                  <div class="about_con  mt-3 " >
                      <img src="./image/image_about9.jpg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="about-title">HOẠT ĐỘNG DU LỊCH</h5>
                        <p class="about-text">Tạo nét <b>độc đáo và khác biệt</b> trong từng bức ảnh. Chất liệu thoáng mát co giãn, cho chuyến đi thêm tuyệt vời.</p>
                        <p>Đừng quên Bộ sưu tập ấn tượng như <b>Miền Gió Cát, The Seafarer.</b></p>
                      </div>
            </div>
          </div>
        </div>
            
          </div>
        </div>
        <div class="row">
          <img src="./image/image_about10.jpg"  alt="">
        </div>
        <div class="container">
          <div class="row image_last">
            <div class="col-md-4">
            <img src="./image/image_about11.jpg"  class="img-fluid"  alt="">
            </div>
  
            <div class="col-md-4 image_last">
              <img src="./image/image_about12.jpg"  class="img-fluid"  alt="">
            </div>
  
            <div class="col-md-4 image_last">
              <img src="./image/image_about13.jpg"   class="img-fluid"  alt="">
            </div>
  
          </div>
        </div>
       
    </div>
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