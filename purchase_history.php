<?php
session_start();
include("./data_connect/db.php");
if (!isset($_SESSION['user_id'])) {
    echo "Bạn cần đăng nhập để xem lịch sử mua hàng!";
    exit;
}

$user_id = $_SESSION['user_id'];

try {
    $sql_orders = "SELECT order_id, created_at, total_price FROM orders WHERE user_id = ? ORDER BY created_at DESC";
    $stmt_orders = $conn->prepare($sql_orders);
    $stmt_orders->execute([$user_id]);
    $orders = $stmt_orders->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Lỗi khi lấy lịch sử mua hàng: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="./fonts/fontawesome-free-6.5.2-web/fontawesome-free-6.5.2-web/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <title>Lịch sử mua hàng</title>
</head>

<body>

    <?php
    include("web/header.php");
    ?>
    <div class="content">

        <div class="container">

            <!-- banner -->
            <?php

            include("./web/banner.php"); ?>

            <div class="row">
                <div class="col-12">
                    <div class="card shadow p-3 mb-5 bg-white rounded">
                        <h2 class="text-center">Lịch sử mua hàng</h2>

                        <?php 
                        
                         if (empty($orders)): ?>
                            <p>Bạn chưa có đơn hàng nào.</p>
                        <?php else: ?>
                            <?php foreach ($orders as $order): 
                              $vat_rate = 0.08;
                                 $subtotal = $order['total_price'] / (1 + $vat_rate); // Giá chưa VAT
                                 $vat = $order['total_price'] - $subtotal; // Phần VAT
                                ?>
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <a href="order_detail.php?order_id=<?php echo $order['order_id']; ?>" style="text-decoration: none;">
                                            <strong>Mã đơn hàng:</strong> <?php echo $order['order_id']; ?><br>
                                            <strong>Ngày đặt:</strong> <?php echo $order['created_at']; ?><br>
                                            <strong>VAT(8%):</strong> <?php echo number_format( $vat, 0, ',', '.'); ?>đ<br>
                                            <strong>Tổng tiền:</strong> <?php echo number_format($order['total_price'], 0, ',', '.'); ?>đ
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">Chi tiết đơn hàng</h5>
                                        <ul class="list-group">
                                            <?php
                                            try {
                                                $sql_items = "SELECT oi.product_id, p.name, p.image_url, oi.quantity, oi.price 
                                                 FROM order_items oi 
                                                 JOIN products p ON oi.product_id = p.product_id 
                                                 WHERE oi.order_id = ?";
                                                $stmt_items = $conn->prepare($sql_items);
                                                $stmt_items->execute([$order['order_id']]);
                                                $items = $stmt_items->fetchAll(PDO::FETCH_ASSOC);

                                                foreach ($items as $item): ?>
                                                    <li class="list-group-item d-flex align-items-center">
                                                        <!-- Ảnh sản phẩm -->
                                                        <div>
                                                            <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>"
                                                                style="width: 80px; height: 80px; object-fit: cover; margin-right: 15px;">
                                                        </div>
                                                        <!-- Nội dung sản phẩm -->
                                                        <div>
                                                            <strong>Sản phẩm:</strong> <?php echo htmlspecialchars($item['name']); ?><br>
                                                            <strong>Số lượng:</strong> <?php echo $item['quantity']; ?><br>
                                                            <strong>Đơn giá:</strong> <?php echo number_format($item['price'], 0, ',', '.'); ?>đ<br>
                                                            <strong>Tổng:</strong> <?php echo number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?>đ
                                                        </div>
                                                    </li>
                                            <?php endforeach;
                                            } catch (PDOException $e) {
                                                echo "Lỗi khi lấy chi tiết đơn hàng: " . $e->getMessage();
                                            }
                                            ?>
                                        </ul>

                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
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