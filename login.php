<?php
include("./data_connect/db.php"); // Kết nối cơ sở dữ liệu
ini_set('session.cookie_lifetime', 300);

// Thiết lập thời gian session kéo dài 5 phút
ini_set('session.gc_maxlifetime', 300);

session_start();
// Khởi tạo biến lỗi (nếu có)
$error = "";

// Kiểm tra xem người dùng có gửi form đăng nhập không
if (isset($_POST['login'])) {
    // Lấy dữ liệu từ form đăng nhập
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Truy vấn cơ sở dữ liệu để kiểm tra người dùng
    $sql_check_user = "SELECT * FROM user WHERE username = '$username'";
    $result_check = $conn->query($sql_check_user);

    if ($result_check->num_rows > 0) {
        // Nếu người dùng tồn tại, kiểm tra mật khẩu
        $user = $result_check->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Nếu mật khẩu đúng, đăng nhập thành công
            $_SESSION['user_id'] = $user['Id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['avatar'] = $user['avatar'];
            $_SESSION['role'] = $user['role'];


            if ($user['role'] == 'admin') {
                header("Location: admin/admin_product.php"); 
            } else {
                header("Location: index.php"); 
            }
            exit();
            
        } else {
            // Nếu mật khẩu không đúng
            $error = "Mật khẩu không đúng.";
        }
    } else {
        // Nếu tên người dùng không tồn tại
        $error = "Tên người dùng không tồn tại.";
    }
}
?>

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
    <title>Đăng nhập</title>
</head>
<body>
    <!-- menu -->
    <?php include("web/header.php"); ?>

    <!-- nội dung chính -->
    <div class="content">
        <div class="container">
            <!-- banner -->
            <?php include("./web/banner.php"); ?>

            <!-- login -->
            <div class="bg d-flex align-items-center justify-content-center m-3" id="login">
                <div class="card shadow p-3 mb-5 bg-white rounded" style="width: 25rem;">
                    <div class="card-body">
                        <h5 class="card-title text-center">Đăng nhập</h5>

                        <!-- Form đăng nhập -->
                        <form method="post" action="">
                            <div class="form-group">
                                <label for="username">Tên người dùng</label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Nhập tài khoản" required>
                                <div class="error-message text-danger"><?php echo $error; ?></div>
                            </div>
                            <div class="form-group">
                                <label for="password">Mật khẩu</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Nhập mật khẩu" required>
                            </div>
                            <button type="submit" name="login" class="btn btn-primary btn-block">Đăng nhập</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include("web/footer.php"); ?>

    <script src="./js/bootstrap.bundle.js"></script>
</body>
</html>