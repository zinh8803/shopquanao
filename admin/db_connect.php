<?php

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "yame";

// try {
//     $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     echo "Kết nối thất bại: " . $e->getMessage();
// }
$host = "sql207.infinityfree.com"; // Ví dụ: sql.somee.com
$dbname = "if0_37911815_yamezinh";
$username = "if0_37911815";
$password = "WtduoMila2zJAs2";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Kết nối thất bại: " . $e->getMessage());
}
?>