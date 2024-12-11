<?php
include("./data_connect/db.php");
session_start(); // Khởi tạo session

// Truy vấn lấy sản phẩm áo (category_id = 1)
$sql_ao = "SELECT product_id, name, description, price, image_url FROM products WHERE category_id = 1";
$result_ao = $conn->query($sql_ao);

// Truy vấn lấy sản phẩm quần (category_id = 2)
$sql_quan = "SELECT product_id, name, description, price, image_url FROM products WHERE category_id = 2";
$result_quan = $conn->query($sql_quan);

// Xử lý thêm vào giỏ hàng
if (isset($_GET['add'])) {
    $product_id = $_GET['add']; // Lấy product_id từ tham số URL

    // Kiểm tra xem giỏ hàng (session) đã có chưa, nếu chưa thì khởi tạo giỏ hàng mới
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array(); // Khởi tạo giỏ hàng nếu chưa có
    }

    // Thêm sản phẩm vào giỏ hàng (kiểm tra nếu sản phẩm đã có trong giỏ thì tăng số lượng)
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += 1; // Tăng số lượng sản phẩm trong giỏ
    } else {
        $_SESSION['cart'][$product_id] = 1; // Thêm sản phẩm mới vào giỏ
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
    <title>Sản phẩm</title>
</head>
<body>
    <!-- menu -->
    <?php include("./web/header.php"); ?>

    <!-- nội dung chính -->
    <div class="content">
        <div class="container">
            <!-- banner -->
            <?php include("./web/banner.php"); ?>

            <!-- Hiển thị sản phẩm áo -->
            <div class="services mb-3">
                <div class="services_title border-bottom">
                    <h2>Sản phẩm Áo</h2>
                </div>
                <div class="row d-flex justify-content-around">
                    <?php
                    // Hiển thị sản phẩm áo
                    if ($result_ao->num_rows > 0) {
                        while ($row = $result_ao->fetch_assoc()) {
                            $product_id = $row['product_id'];
                            $name = $row['name'];
                            $price = number_format($row['price'], 0, ',', '.');
                            $image_url = $row['image_url'];
                    ?>
                    <div class="product_men card mt-3" style="width: 18rem;">
                        <img src="<?php echo $image_url; ?>" class="card-img-top" alt="<?php echo $name; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $name; ?></h5>
                            <p class="card-text1"><i class="fas fa-shopping-cart"></i> <b><?php echo $price; ?>đ</b></p>
                            <a href="?add=<?php echo $product_id; ?>" class="btn btn-primary">Thêm vào giỏ hàng</a>
                        </div>
                    </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>

            <!-- Hiển thị sản phẩm quần -->
            <div class="services mb-3">
                <div class="services_title border-bottom">
                    <h2>Sản phẩm Quần</h2>
                </div>
                <div class="row d-flex justify-content-around">
                    <?php
                    // Hiển thị sản phẩm quần
                    if ($result_quan->num_rows > 0) {
                        while ($row = $result_quan->fetch_assoc()) {
                            $product_id = $row['product_id'];
                            $name = $row['name'];
                            $price = number_format($row['price'], 0, ',', '.');
                            $image_url = $row['image_url'];
                    ?>
                    <div class="product_men card mt-3" style="width: 18rem;">
                        <img src="<?php echo $image_url; ?>" class="card-img-top" alt="<?php echo $name; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $name; ?></h5>
                            <p class="card-text1"><i class="fas fa-shopping-cart"></i> <b><?php echo $price; ?>đ</b></p>
                            <a href="?add=<?php echo $product_id; ?>" class="btn btn-primary">Thêm vào giỏ hàng</a>
                        </div>
                    </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include("./web/footer.php"); ?>

    <script src="./js/bootstrap.bundle.js"></script>
</body>
</html>
