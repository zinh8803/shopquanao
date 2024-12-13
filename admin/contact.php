<?php
session_start();
include("db_connect.php");

// Kiểm tra quyền truy cập
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Lấy danh sách liên hệ
$sql_contacts = "SELECT * FROM contacts ORDER BY created_at DESC";
$stmt_contacts = $conn->prepare($sql_contacts);
$stmt_contacts->execute();
$contacts = $stmt_contacts->fetchAll(PDO::FETCH_ASSOC);
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
    .table td:nth-child(5) { /* Điều chỉnh cột thứ 5 (Lời nhắn) */
    max-width: 400px; /* Đặt độ rộng tối đa */
    white-space: pre-wrap; /* Ngắt dòng khi quá dài */
    word-wrap: break-word; /* Ngắt từ dài */
}

</style>
<body>
<?php include("includes/sidebar.php"); ?>


<div class="content">
<div class="container mt-5">
    <h2 class="text-center">Quản lý Liên hệ</h2>
    <table class="table table-bordered">
    <thead class="table">
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th class="w-50">Lời nhắn</th> <!-- Đặt độ rộng cho cột -->
            <th>Ngày gửi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><?php echo $contact['id']; ?></td>
                <td><?php echo htmlspecialchars($contact['name']); ?></td>
                <td><?php echo htmlspecialchars($contact['email']); ?></td>
                <td><?php echo htmlspecialchars($contact['phone']); ?></td>
                <td><?php echo nl2br(htmlspecialchars($contact['message'])); ?></td>
                <td><?php echo $contact['created_at']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
