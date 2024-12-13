<?php
session_start();
include("../data_connect/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'] ?? null;
    $confirm_password = $_POST['confirm_password'] ?? null;
    $avatar = $_FILES['avatar'];

    // Mặc định thông báo lỗi
    $response = ['success' => false, 'message' => ''];

    if ($password && $password !== $confirm_password) {
        $response['message'] = 'Mật khẩu xác nhận không khớp!';
    } else {
        $avatar_path = $_SESSION['avatar'];
        if ($avatar && $avatar['error'] === 0) {
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($avatar['type'], $allowed_types)) {
                $target_dir = "image_avata/";
                $avatar_path = $target_dir . basename($avatar['name']);
                move_uploaded_file($avatar['tmp_name'], $avatar_path);
            }
        }

        try {
            $sql = "UPDATE user SET gender = ?, phone = ?, address = ?, avatar = ?" 
                . ($password ? ", password = ?" : "") 
                . " WHERE Id = ?";
            $params = [$gender, $phone, $address, $avatar_path];
            if ($password) {
                $params[] = password_hash($password, PASSWORD_BCRYPT);
            }
            $params[] = $user_id;

            $stmt = $conn->prepare($sql);
            $stmt->execute($params);

            $_SESSION['avatar'] = $avatar_path;
            $response['success'] = true;
            $response['message'] = 'Thông tin đã được cập nhật thành công!';
        } catch (PDOException $e) {
            $response['message'] = 'Lỗi khi cập nhật thông tin: ' . $e->getMessage();
        }
    }

    echo json_encode($response);
}
?>
