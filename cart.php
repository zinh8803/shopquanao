<?php
session_start(); // Khởi tạo session
include("./data_connect/db.php");

// Kiểm tra nếu giỏ hàng có sản phẩm
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    // Lấy tất cả product_id từ giỏ hàng
    $product_ids = array_keys($_SESSION['cart']);

    // Truy vấn để lấy thông tin các sản phẩm từ database
    $ids = implode(',', $product_ids);
    $sql = "SELECT product_id, name, description, price, image_url FROM products WHERE product_id IN ($ids)";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <title>Giỏ hàng</title>
</head>
<body>
    <?php include("./web/header.php"); ?> <!-- Header -->

    <div class="container mt-5">
        <h2>Giỏ hàng của bạn</h2>
        
        <?php
        if (isset($result) && $result->num_rows > 0) {
            // Duyệt qua các sản phẩm trong giỏ hàng
            while ($row = $result->fetch_assoc()) {
                $product_id = $row['product_id'];
                $name = $row['name'];
                $price = number_format($row['price'], 0, ',', '.');
                $image_url = $row['image_url'];
                $quantity = $_SESSION['cart'][$product_id]; // Lấy số lượng sản phẩm trong giỏ

                echo '
                <div class="row mb-3">
                    <div class="col-md-3">
                        <img src="' . $image_url . '" alt="' . $name . '" class="img-fluid">
                    </div>
                    <div class="col-md-6">
                        <h5>' . $name . '</h5>
                        <p>' . $row['description'] . '</p>
                        <p><b>' . $price . 'đ</b></p>
                    </div>
                    <div class="col-md-3">
                        <p><strong>Số lượng: </strong>' . $quantity . '</p>
                        <p><strong>Tổng: </strong>' . number_format($price * $quantity, 0, ',', '.') . 'đ</p>
                    </div>
                </div>';
            }
            
            // Tính tổng giá trị giỏ hàng
            $total = 0;
            foreach ($_SESSION['cart'] as $product_id => $quantity) {
                $sql_price = "SELECT price FROM products WHERE product_id = $product_id";
                $result_price = $conn->query($sql_price);
                if ($result_price->num_rows > 0) {
                    $row = $result_price->fetch_assoc();
                    $total += $row['price'] * $quantity;
                }
            }
            echo '<div class="mt-4"><h4>Tổng giá trị giỏ hàng: ' . number_format($total, 0, ',', '.') . 'đ</h4></div>';
        } else {
            echo '<p>Giỏ hàng của bạn hiện tại trống.</p>';
        }
        ?>
    </div>

    <!-- Footer -->
    <?php include("./web/footer.php"); ?>
</body>
</html>
