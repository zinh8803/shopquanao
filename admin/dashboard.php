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
  <?php
  include("includes/sidebar.php")
  ?>

    <!-- Content -->
    <div class="content">
        <h1>Admin Dashboard</h1>
        <!-- Summary Boxes -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5>Total Orders</h5>
                        <p class="fs-4">3</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5>Total Amount</h5>
                        <p class="fs-4">$481.34</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5>Pending Orders</h5>
                        <p class="fs-4">3</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center">
                    <div class="card-body">
                        <h5>Cancelled Orders</h5>
                        <p class="fs-4">0</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart -->
        <div class="card mb-4">
            <div class="card-body">
                <h5>Earnings Revenue</h5>
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="card">
            <div class="card-body">
                <h5>Recent Orders</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Order No</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Subtotal</th>
                            <th>Tax</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Order Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Divyansh Kumar</td>
                            <td>1234567891</td>
                            <td>$172.00</td>
                            <td>$36.12</td>
                            <td>$208.12</td>
                            <td>Ordered</td>
                            <td>2024-07-11 00:54:14</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Chart.js Example
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [
                    {
                        label: 'Revenue',
                        data: [1200, 1900, 3000, 5000, 2000, 3000, 4500],
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    },
                    {
                        label: 'Orders',
                        data: [800, 1400, 2000, 4000, 1800, 2500, 4000],
                        backgroundColor: 'rgba(255, 206, 86, 0.6)',
                    }
                ]
            }
        });
    </script>
</body>
</html>
