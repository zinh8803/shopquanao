<?php
include("db_connect.php");

// Lấy chi tiết đơn hàng
if (isset($_GET['order_id'])) {
    $order_id = (int)$_GET['order_id'];

    $sql_order = "SELECT orders.*, 
                         products.product_id, 
                         products.name AS product_name, 
                         products.image_url, 
                         order_items.quantity, 
                         order_items.price
                  FROM orders 
                  INNER JOIN order_items ON orders.order_id = order_items.order_id
                  INNER JOIN products ON order_items.product_id = products.product_id
                  WHERE orders.order_id = ?";
    $stmt_order = $conn->prepare($sql_order);
    $stmt_order->execute([$order_id]);
    $order_details = $stmt_order->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>
<style>
    body {
        background-color: #f8f9fa;
    }
    .sidebar {
        min-width: 240px;
        background-color: #343a40;
        height: 100vh;
        color: #fff;
    }
    .sidebar a {
        color: #adb5bd;
        text-decoration: none;
        padding: 10px;
        display: block;
    }
    .sidebar a:hover {
        background-color: #495057;
        color: #fff;
    }
    .content {
        margin-left: 240px;
        padding: 20px;
    }
</style>
<body>
<?php include("includes/sidebar.php"); ?>


<div class="content">
<div class="container mt-5">
    <h2 class="text-center">Chi tiết Đơn hàng #<?php echo $order_id; ?></h2>
    <table class="table table-bordered">
        <thead class="table-danger">
        <tr>
            <th>ID Sản phẩm</th>
            <th>Ảnh sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Thành tiền</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($order_details as $detail): ?>
            <tr>
                <td class="text-center"><?php echo $detail['product_id']; ?></td>
                <td class="text-center">
                    <img src="<?php echo "../". htmlspecialchars($detail['image_url']); ?>" alt="<?php echo htmlspecialchars($detail['product_name']); ?>" 
                         style="width: 50px; height: 50px; object-fit: cover;">
                </td>
                <td><?php echo htmlspecialchars($detail['product_name']); ?></td>
                <td class="text-center"><?php echo $detail['quantity']; ?></td>
                <td class="text-end"><?php echo number_format($detail['price'], 0, ',', '.'); ?>đ</td>
                <td class="text-end"><?php echo number_format($detail['quantity'] * $detail['price'], 0, ',', '.'); ?>đ</td>
            </tr>
         
        <?php endforeach; ?>
        </tbody>
    </table>
    <a class="btn btn-primary" href="order.php">quay lại </a>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
