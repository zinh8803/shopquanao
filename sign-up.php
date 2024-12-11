<?php
include("./data_connect/db.php"); 

$error = "";

if(isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $sql_check_username = "SELECT * FROM user WHERE username = '$username'";
    $result_check = $conn->query($sql_check_username);

    if($result_check->num_rows > 0) {
        $error = "Tên người dùng đã tồn tại. Vui lòng chọn tên khác.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql_insert_user = "INSERT INTO user (username, password, email) VALUES ('$username', '$hashed_password', '$email')";
        
        if($conn->query($sql_insert_user) === TRUE) {
            header("Location: ./login.php"); // Chuyển hướng đến trang đăng nhập
            exit();
        } else {
            $error = "Đã có lỗi xảy ra. Vui lòng thử lại.";
        }
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
    <title>Đăng Ký</title>
</head>
<body>
    <!-- menu -->
    <?php include("web/header.php"); ?>

    <!-- Nội dung chính -->
    <div class="content">
        <div class="container">
            <!-- banner -->
            <?php include("./web/banner.php"); ?>

            <!-- Đăng ký -->
            <div class="bg d-flex align-items-center justify-content-center">
                <div class="card shadow p-3 mb-5 bg-white rounded" style="width: 25rem;">
                    <div class="card-body">
                        <h5 class="card-title text-center">Đăng Ký</h5>
                       
                        <?php if($error): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                       
                        <form method="post">
                            <div class="form-group">
                                <label for="username">Tên người dùng</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên người dùng" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Mật khẩu</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" required>
                            </div>
                            <button type="submit" name="register" class="btn btn-primary">Đăng Ký</button>
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
