><style>
    /* Footer */
.footer {
    background-color: #343a40; /* Màu nền giống header */
    color: #ffffff; /* Màu chữ trắng */
    padding: 40px 0;
    font-size: 14px;
}

.footer h6 {
    color: #f8b400; /* Màu cam cho tiêu đề nổi bật */
    font-weight: bold;
    margin-bottom: 20px;
}

.footer__about ul,
.footer__widget ul {
    list-style: none;
    padding: 0;
}

.footer__about ul li,
.footer__widget ul li {
    margin-bottom: 10px;
    line-height: 1.6;
}

.footer__about ul li i {
    margin-right: 8px;
    color: #f8b400; /* Màu cam cho icon */
}

.footer__widget ul li a {
    color: #ffffff; /* Màu chữ trắng */
    text-decoration: none;
    transition: all 0.3s ease;
}

.footer__widget ul li a:hover {
    color: #f8b400; /* Hiệu ứng hover đổi màu */
    text-decoration: underline;
}

/* Form đăng ký */
.footer__widget form {
    display: flex;
    margin-top: 15px;
}

.footer__widget input.search {
    flex: 1;
    border: none;
    border-radius: 20px 0 0 20px;
    padding: 10px 15px;
    outline: none;
}

.footer__widget .btn0 {
    background-color: #f8b400;
    border: none;
    border-radius: 0 20px 20px 0;
    color: #ffffff;
    padding: 10px 20px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.footer__widget .btn0:hover {
    background-color: #ffffff;
    color: #f8b400;
}

/* Responsive cho màn hình nhỏ */
@media (max-width: 768px) {
    .footer__widget ul {
        margin-bottom: 20px;
    }
}

</style>

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