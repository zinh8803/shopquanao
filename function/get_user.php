<?php
session_start();
include("../data_connect/db.php");

$response = ['success' => false, 'message' => '', 'user' => null];

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    try {
        $sql = "SELECT username, email, gender, phone, address, avatar FROM user WHERE Id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $response['success'] = true;
            $response['user'] = $user;
        } else {
            $response['message'] = "Không tìm thấy người dùng.";
        }
    } catch (PDOException $e) {
        $response['message'] = "Lỗi khi lấy thông tin người dùng: " . $e->getMessage();
    }
} else {
    $response['message'] = "Người dùng chưa đăng nhập.";
}

echo json_encode($response);
?>
