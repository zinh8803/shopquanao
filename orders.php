<?php
include("./data_connect/db.php");
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Bạn cần đăng nhập để xem đơn hàng!'); window.location.href = 'login.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC");
$stmt->execute([$user_id]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn Hàng</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Đơn Hàng Của Tôi</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Mã Đơn Hàng</th>
                <th>Ngày Đặt</th>
                <th>Tổng Giá</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo $order['order_id']; ?></td>
                    <td><?php echo $order['order_date']; ?></td>
                    <td><?php echo number_format($order['total_price'], 0, ',', '.'); ?>đ</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
