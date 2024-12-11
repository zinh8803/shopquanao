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
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <title>Sản phẩm</title>
</head>
<body>
<style>
    .product_men {
    transition: all 0.3s ease-in-out;
    overflow: hidden;
    border: none;
    border-radius: 10px; /* Bo góc */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Đổ bóng nhẹ */
}

.product_men img {
    transition: transform 0.3s ease-in-out, filter 0.3s ease-in-out;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.product_men:hover {
    transform: translateY(-8px); /* Di chuyển lên một chút */
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); /* Tăng độ đổ bóng */
}

.product_men:hover img {
    transform: scale(1.1); /* Phóng to ảnh khi hover */
    filter: brightness(0.9); /* Làm tối ảnh một chút */
}

.card-body h5.card-title {
    font-size: 1.2rem;
    font-weight: bold;
    text-align: center;
    color: #333;
    margin-bottom: 10px;
}

.card-body p.card-text1 {
    font-size: 1.1rem;
    text-align: center;
    color: #888;
    margin-bottom: 15px;
}

.card-body a.btn {
    display: block;
    background: linear-gradient(90deg, #007bff, #0056b3);
    color: white;
    text-align: center;
    transition: background 0.3s ease-in-out, transform 0.2s;
}

.card-body a.btn:hover {
    background: linear-gradient(90deg, #0056b3, #004085);
    transform: scale(1.05); /* Phóng to nút nhẹ */
}

</style>



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
