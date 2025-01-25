<?php
include("./data_connect/db.php");
session_start();
include("update_online.php");
$userId = $_SESSION['user_id'] ?? null;
trackUser($conn, $userId);

$stmt = $conn->prepare("SELECT COUNT(*) as total_visitors FROM online_users");
$stmt->execute();
$totalVisitors = $stmt->fetch()['total_visitors'];

$stmt = $conn->prepare("SELECT COUNT(*) as logged_in_users FROM online_users WHERE user_id IS NOT NULL");
$stmt->execute();
$loggedInUsers = $stmt->fetch()['logged_in_users'];

$notLoggedInUsers = $totalVisitors - $loggedInUsers;

echo json_encode([
    'total_visitors' => $totalVisitors,
    'logged_in_users' => $loggedInUsers,
    'not_logged_in_users' => $notLoggedInUsers,
]);
?>
