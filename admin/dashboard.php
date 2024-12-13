<?php
session_start();
include("db_connect.php");

// Kiểm tra quyền truy cập
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Tạm thời đặt số lượng đơn hàng pending và cancelled là 0
$pending_orders = 0;
$cancelled_orders = 0;

// Lấy tổng số đơn hàng
$sql_total_orders = "SELECT COUNT(order_id) AS total_orders FROM orders";
$stmt_total_orders = $conn->prepare($sql_total_orders);
$stmt_total_orders->execute();
$total_orders = $stmt_total_orders->fetch(PDO::FETCH_ASSOC)['total_orders'];

// Lấy tổng doanh thu
$sql_total_revenue = "SELECT SUM(total_price) AS total_revenue FROM orders";
$stmt_total_revenue = $conn->prepare($sql_total_revenue);
$stmt_total_revenue->execute();
$total_revenue = $stmt_total_revenue->fetch(PDO::FETCH_ASSOC)['total_revenue'];

// Tính toán doanh thu theo ngày (giới hạn 30 ngày gần nhất)
$sql_daily_revenue = "
    SELECT 
        DATE(created_at) AS order_date, 
        SUM(total_price) AS total_revenue 
    FROM orders 
    WHERE created_at >= NOW() - INTERVAL 30 DAY
    GROUP BY DATE(created_at) 
    ORDER BY order_date ASC";
$stmt_daily_revenue = $conn->prepare($sql_daily_revenue);
$stmt_daily_revenue->execute();
$daily_revenue_data = $stmt_daily_revenue->fetchAll(PDO::FETCH_ASSOC);

// Chuẩn bị dữ liệu cho biểu đồ
$order_dates = [];
$daily_revenues = [];
foreach ($daily_revenue_data as $row) {
    $order_dates[] = $row['order_date'];
    $daily_revenues[] = $row['total_revenue'];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <title>Admin Dashboard</title>
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
</head>
<body>
    <!-- Sidebar -->
    <?php include("includes/sidebar.php"); ?>

    <!-- Content -->
    <div class="content">
        <h1>Admin Dashboard</h1>

        <!-- Summary Boxes -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5>Total Orders</h5>
                        <p class="fs-4"><?php echo $total_orders; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5>Total Revenue</h5>
                        <p class="fs-4"><?php echo number_format($total_revenue, 0, ',', '.'); ?>đ</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5>Pending Orders</h5>
                        <p class="fs-4"><?php echo $pending_orders; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5>Cancelled Orders</h5>
                        <p class="fs-4"><?php echo $cancelled_orders; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart -->
        <div class="card mb-4">
            <div class="card-body">
                <h5>Revenue by Day (Last 30 Days)</h5>
                <canvas id="dailyRevenueChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('dailyRevenueChart').getContext('2d');
        const dailyRevenueChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($order_dates); ?>,
                datasets: [{
                    label: 'Daily Revenue (VND)',
                    data: <?php echo json_encode($daily_revenues); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Revenue (VND)'
                        },
                        beginAtZero: true
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return new Intl.NumberFormat().format(context.raw) + " VND";
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>


