<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: 403.php");
    exit();
}
else { header("Location: dashboard.php");
    exit();}

?>
