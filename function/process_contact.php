<?php
include("../data_connect/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $sdt = $_POST['sdt'] ?? '';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';

    if (!empty($name) && !empty($sdt) && !empty($email) && !empty($message)) {
        try {
            $sql = "INSERT INTO contacts (name, phone, email, message) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$name, $sdt, $email, $message]);
            echo "Success";
        } catch (PDOException $e) {
            http_response_code(500);
            echo "Error: " . $e->getMessage();
        }
    } else {
        http_response_code(400);
        echo "Invalid input";
    }
} else {
    http_response_code(405);
    echo "Method not allowed";
}
