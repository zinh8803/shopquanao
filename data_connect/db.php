<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "yame";


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Kết nối thất bại: " . $e->getMessage();
}


?>