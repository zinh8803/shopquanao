<?php
include("../db_connect.php");

if (isset($_GET['id'])) {
    $product_id = (int)$_GET['id']; 

    try {
        $sql_delete = "DELETE FROM products WHERE product_id = :product_id";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bindParam(':product_id', $product_id, PDO::PARAM_INT);

        if ($stmt_delete->execute()) {
            echo '<script>alert("Xóa thành công!"); window.location.href="../admin_product.php";</script>';
        } else {
            echo '<script>alert("Xóa thất bại! Vui lòng thử lại."); window.location.href="../admin_product.php";</script>';
        }
    } catch (PDOException $e) {
        echo '<script>alert("Lỗi hệ thống: ' . $e->getMessage() . '"); window.location.href="../admin_product.php";</script>';
    }
} else {
    echo '<script>alert("Không tìm thấy sản phẩm!"); window.location.href="../admin_product.php";</script>';
}
?>
