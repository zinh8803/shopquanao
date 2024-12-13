



<?php

$cart_count = isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;
?>
<style>
.menu {
    background-color: #343a40; /* Màu nền tối */
    padding: 10px 0;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.navbar-brand img {
    transition: transform 0.3s ease;
}

.navbar-brand img:hover {
    transform: scale(1.1); /* Phóng to logo nhẹ */
}

/* Links trong menu */
.navbar-nav .nav-link {
    color: #ffffff !important;
    text-transform: uppercase;
    font-weight: 500;
    padding: 10px 15px;
    transition: all 0.3s ease;
}

.navbar-nav .nav-link:hover {
    color: #f8b400 !important; /* Màu cam */
    transform: translateY(-2px); /* Hiệu ứng nâng nhẹ */
}

.navbar-nav .nav-link.active {
    color: #f8b400 !important; /* Màu nổi bật */
}

/* Ô tìm kiếm */
.form-control {
    border-radius: 20px;
    border: none;
}

.btn-outline-dark {
    border-radius: 20px;
    color: #f8b400;
    border-color: #f8b400;
    transition: all 0.3s ease;
}

.btn-outline-dark:hover {
    background-color: #f8b400;
    color: #fff;
    border-color: #f8b400;
}

/* Dropdown User */
.dropdown a img {
    border: 2px solid #f8b400;
    transition: transform 0.3s ease;
}

.dropdown a img:hover {
    transform: scale(1.1);
}

.dropdown-menu {
    border: none;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.dropdown-item:hover {
    background-color: #f8b400;
    color: #fff;
}

/* Giỏ hàng */
.shopping {
    color: #ffffff;
    font-size: 1.2rem;
    margin-left: 20px;
    position: relative;
    transition: all 0.3s ease;
}

.shopping:hover {
    color: #f8b400;
    transform: scale(1.2);
}

.badge {
    font-size: 0.75rem;
    border-radius: 50%;
}
/* Dropdown */
.dropdown-menu {
    border: none;
    border-radius: 8px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    background-color: #ffffff;
    padding: 10px 0;
    min-width: 200px;
}

.dropdown-item {
    color: #343a40;
    padding: 10px 20px;
    font-size: 14px;
    transition: all 0.3s ease;
}

.dropdown-item:hover {
    background-color: #f8b400;
    color: #ffffff;
    font-weight: 500;
}

.dropdown-divider {
    margin: 5px 0;
    border-top: 1px solid #ddd;
}

.dropdown-header {
    font-weight: bold;
    color: #f8b400;
    font-size: 14px;
    padding: 8px 20px;
}

</style>
<div class="menu">
    <div class="header container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                    <img src="./image/yame-f-logo-white.png" width="144px" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link "  href="index.php">about</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="services.php">PRODUCT</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">contact</a>
                        </li>
                        <li class="nav-item">
                            <form class="d-flex" method="GET" action="services.php">
                                <input class="form-control me-2" type="search" name="search" placeholder="tìm kiếm" aria-label="Search"  value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">>
                                <button class="btn btn-outline-dark" type="submit">Search</button>
                            </form>
                        </li>
                    </ul>
                    <div class="dropdown">
                        <a href="#" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php if (isset($_SESSION['username'])): ?>
                                <img src="<?php echo htmlspecialchars(!empty($_SESSION['avatar']) ? $_SESSION['avatar'] : 'image_avata/avatar.png'); ?>" 
                                     alt="Avatar" 
                                     class="rounded-circle" 
                                     style="width: 35px; height: 35px; object-fit: cover;">
                            <?php else: ?>
                                <i class="fa-regular fa-user m-2" style="font-size: 20px;"></i>
                            <?php endif; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <?php if (isset($_SESSION['username'])): ?>
                                <li class="dropdown-header">Xin chào, <?php echo htmlspecialchars($_SESSION['username']); ?></li>
                                <li><a class="dropdown-item" href="edit_profile.php"><i class="fa-solid fa-user-pen"></i> Chỉnh sửa thông tin</a></li>
                                <li><a class="dropdown-item" href="purchase_history.php"><i class="fa-solid fa-clock-rotate-left"></i> Lịch sử mua hàng</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="login.php"><i class="fa-solid fa-right-to-bracket"></i> Đăng nhập</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <!-- Shopping Icon -->
                    <a href="cart.php" class="shopping position-relative">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
                            <?php echo $cart_count; ?>
                        </span>
                    </a>
                </div>
            </div>
        </nav>
    </div>
</div>





