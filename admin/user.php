<?php
session_start();
include("db_connect.php");

// Kiểm tra quyền truy cập
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Lấy danh sách người dùng trừ vai trò admin
$sql_users = "SELECT id, username, email, avatar, role, gender, phone, address 
              FROM user
              WHERE role != 'admin' 
              ORDER BY id ASC";
$stmt_users = $conn->prepare($sql_users);
$stmt_users->execute();
$users = $stmt_users->fetchAll(PDO::FETCH_ASSOC);
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
<h2 class="text-center">Danh sách người dùng</h2>

<div class="table-responsive">
        <table class="table table-bordered table-hover mt-3">
            <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
              
                <th>Vai trò</th>
                <th>Giới tính</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                 
                    <td><?php echo htmlspecialchars($user['role']); ?></td>
                    <td><?php echo htmlspecialchars($user['gender']); ?></td>
                    <td><?php echo htmlspecialchars($user['phone']); ?></td>
                    <td><?php echo htmlspecialchars($user['address']); ?></td>
                    <td class="text-center">
                        <a href="edit_user.php?id=<?php echo $user['id']; ?>" class="btn btn-warning btn-sm">
                            <i class="fa-solid fa-pen"></i> Sửa
                        </a>
                        <a href="delete_user.php?id=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này không?');">
                            <i class="fa-solid fa-trash"></i> Xóa
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
