<?php
session_start();
include("./data_connect/db.php");

// Kiểm tra nếu người dùng chưa đăng nhập
if (!isset($_SESSION['user_id'])) {
    echo "Bạn cần đăng nhập để xem chi tiết đơn hàng!";
    exit;
}

$order_id = $_GET['order_id'] ?? null;
if (!$order_id) {
    echo "Mã đơn hàng không hợp lệ!";
    exit;
}

try {
    // Lấy thông tin đơn hàng
    $sql_order = "SELECT * FROM orders WHERE order_id = ?";
    $stmt_order = $conn->prepare($sql_order);
    $stmt_order->execute([$order_id]);
    $order = $stmt_order->fetch(PDO::FETCH_ASSOC);

    if (!$order) {
        echo "Đơn hàng không tồn tại!";
        exit;
    }
    $sql_items = "SELECT oi.product_id, p.name,p.image_url, oi.quantity, oi.price 
                  FROM order_items oi 
                  JOIN products p ON oi.product_id = p.product_id 
                  WHERE oi.order_id = ?";
    $stmt_items = $conn->prepare($sql_items);
    $stmt_items->execute([$order_id]);
    $items = $stmt_items->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Lỗi khi lấy chi tiết đơn hàng: " . $e->getMessage();
    exit;
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
    <title>chi tiết lịch sử </title>
</head>
<body>
    <!-- menu -->
    <?php include("web/header.php"); ?>

    <!-- nội dung chính -->
    <div class="content">
        <div class="container">
            <!-- banner -->
            <?php include("./web/banner.php"); ?>

            <div class="container mt-5">
    <h2>Chi tiết đơn hàng</h2>
    <div class="card mb-3">
    <div class="card-header">
    <h5 class="card-title">Danh sách sản phẩm</h5>
    <ul class="list-group">
        <?php foreach ($items as $item): ?>
            <li class="list-group-item d-flex align-items-center">
                <!-- Ảnh sản phẩm -->
                <div>
                    <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" 
                         style="width: 80px; height: 80px; object-fit: cover; margin-right: 15px;">
                </div>
                <!-- Thông tin sản phẩm -->
                <div>
                    <strong>Sản phẩm:</strong> <?php echo htmlspecialchars($item['name']); ?><br>
                    <strong>Số lượng:</strong> <?php echo $item['quantity']; ?><br>
                    <strong>Đơn giá:</strong> <?php echo number_format($item['price'], 0, ',', '.'); ?>đ<br>
                    <strong>Tổng:</strong> <?php 
                    

                    echo number_format($item['quantity'] * $item['price'], 0, ',', '.'); ?>đ
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

        <div class="card-body">
        <strong>Mã đơn hàng:</strong> <?php echo $order['order_id']; ?><br>
            <strong>Ngày đặt:</strong> <?php echo $order['created_at']; ?><br>
            <strong>Tên khách hàng:</strong> <?php echo htmlspecialchars($order['customer_name']); ?><br>
            <strong>Email:</strong> <?php echo htmlspecialchars($order['email']); ?><br>
            <strong>Địa chỉ:</strong> <?php echo htmlspecialchars($order['address']); ?><br>
            <strong>Số điện thoại:</strong> <?php echo htmlspecialchars($order['phone']); ?><br>
            <strong>Tổng tiền:</strong> <?php echo number_format($order['total_price'], 0, ',', '.'); ?>đ
           
           <div class=""><a href="index.php" class="btn btn-secondary">Tiếp tục mua sắm</a></div> 
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
