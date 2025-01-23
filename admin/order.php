<?php
session_start();
include("db_connect.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$items_per_page = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $items_per_page;

$sql_orders = "SELECT order_id, customer_name, email, address, phone, total_price, created_at 
               FROM orders 
               ORDER BY created_at DESC 
               LIMIT :limit OFFSET :offset";
$stmt_orders = $conn->prepare($sql_orders);
$stmt_orders->bindValue(':limit', $items_per_page, PDO::PARAM_INT);
$stmt_orders->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt_orders->execute();
$orders = $stmt_orders->fetchAll(PDO::FETCH_ASSOC);

$total_orders_sql = "SELECT COUNT(*) FROM orders";
$total_orders_stmt = $conn->prepare($total_orders_sql);
$total_orders_stmt->execute();
$total_orders = $total_orders_stmt->fetchColumn();

$total_pages = ceil($total_orders / $items_per_page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>
<body>
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
    .table {
        margin-top: 20px;
        font-size: 1rem;
    }
    .table th, .table td {
        padding: 15px;
        vertical-align: middle;
    }
    .table th {
        font-size: 1.1rem;
    }
    .table thead {
        background-color: #f8d7da;
    }
</style>

<?php include("includes/sidebar.php"); ?>

<div class="content">
    <div class="container mt-5">
        <h2 class="text-center">Quản lý Đơn hàng</h2>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-danger">
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Tên khách hàng</th>
                    <th>Email</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo $order['order_id']; ?></td>
                        <td><?php echo htmlspecialchars($order['customer_name']); ?></td>
                        <td><?php echo htmlspecialchars($order['email']); ?></td>
                        <td><?php echo htmlspecialchars($order['address']); ?></td>
                        <td><?php echo htmlspecialchars($order['phone']); ?></td>
                        <td><?php echo $order['created_at']; ?></td>
                        <td class="text-end"><?php echo number_format($order['total_price'], 0, ',', '.'); ?>đ</td>
                        <td class="text-center">
                            <a href="order_detail.php?order_id=<?php echo $order['order_id']; ?>" class="btn btn-primary btn-sm">
                                <i class="fa-solid fa-eye"></i> Xem chi tiết
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                   
                    <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                        <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>

                 
                    <li class="page-item <?php if ($page >= $total_pages) echo 'disabled'; ?>">
                        <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
