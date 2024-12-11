<div class="menu ">
    <div class="header container ">
        <nav class="navbar navbar-expand-lg navbar-light ">
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
                            <a class="nav-link active" aria-current="page" href="index.php">about</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="services.php">PRODUCT</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pricing.php">pricing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="lab.php">Lab</a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="tìm kiếm" aria-label="Search">
                        <button class="btn btn-outline-dark" type="submit">Search</button>
                    </form>

                    <!-- User Dropdown -->
                    <div class="dropdown">
                        <a href="#" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php if (isset($_SESSION['username'])): ?>
                                <!-- Hiển thị avatar -->
                                <img src="<?php echo htmlspecialchars(!empty($_SESSION['avatar']) ? $_SESSION['avatar'] : 'image_avata/avatar.png'); ?>" 
                                     alt="Avatar" 
                                     class="rounded-circle" 
                                     style="width: 35px; height: 35px; object-fit: cover;">
                            <?php else: ?>
                                <!-- Hiển thị icon user mặc định -->
                                <i class="fa-regular fa-user m-2" style="font-size: 20px;"></i>
                            <?php endif; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <?php if (isset($_SESSION['username'])): ?>
                                <li><a class="dropdown-item" href="#">Xin chào, <?php echo htmlspecialchars($_SESSION['username']); ?></a></li>
                                <li><a class="dropdown-item" href="edit_profile.php">Chỉnh sửa thông tin</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="logout.php">Đăng xuất</a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="login.php">Đăng nhập</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <!-- Shopping Icon -->
                    <a href="cart.php" class="shopping"><i class="fa-solid fa-cart-shopping"></i></a>
                </div>
            </div>
        </nav>
    </div>
</div>
