<?php
session_start();
include("./data_connect/db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'] ?? 0;
    $response = [];

    if ($product_id > 0) {
        try {
            $sql = "SELECT stock_quantity FROM products WHERE product_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$product_id]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($product) {
                $stock_quantity = $product['stock_quantity'];

                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = [];
                }

                $current_quantity = $_SESSION['cart'][$product_id] ?? 0;

                if ($current_quantity < $stock_quantity) {
                    $_SESSION['cart'][$product_id] = $current_quantity + 1;
                    $response['success'] = true;
                    $response['message'] = "Đã thêm sản phẩm vào giỏ hàng.";
                    $response['cart_count'] = array_sum($_SESSION['cart']);
                } else {
                    $response['success'] = false;
                    $response['message'] = "Không thể thêm sản phẩm. Tồn kho đã hết.";
                }
            } else {
                $response['success'] = false;
                $response['message'] = "Sản phẩm không tồn tại.";
            }
        } catch (PDOException $e) {
            $response['success'] = false;
            $response['message'] = "Lỗi: " . $e->getMessage();
        }
    } else {
        $response['success'] = false;
        $response['message'] = "ID sản phẩm không hợp lệ.";
    }

    echo json_encode($response);
}
