<?php
// Kết nối database
include("./data_connect/db.php"); 

// Bắt đầu session


// Lấy session ID
function trackUser($conn, $userId = null) {
    $sessionId = session_id();
    $stmt = $conn->prepare("SELECT * FROM online_users WHERE session_id = :session_id");
    $stmt->execute(['session_id' => $sessionId]);
    $user = $stmt->fetch();

    if ($user) {
        // Cập nhật last_activity
        $updateStmt = $conn->prepare("UPDATE online_users SET last_activity = CURRENT_TIMESTAMP, user_id = :user_id WHERE session_id = :session_id");
        $updateStmt->execute(['user_id' => $userId, 'session_id' => $sessionId]);
    } else {
        // Thêm người dùng mới
        $insertStmt = $conn->prepare("INSERT INTO online_users (session_id, user_id) VALUES (:session_id, :user_id)");
        $insertStmt->execute(['session_id' => $sessionId, 'user_id' => $userId]);
    }

    // Xóa người dùng không còn hoạt động (sau 5 phút)
    $timeout = 300; // 5 phút
    $deleteStmt = $conn->prepare("DELETE FROM online_users WHERE last_activity < (NOW() - INTERVAL :timeout SECOND)");
    $deleteStmt->execute(['timeout' => $timeout]);
}

?>
