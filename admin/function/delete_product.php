<?php
include("../db_connect.php");
if (isset($_GET['id'])) {
    $product_id = $_GET['id']; 
    $sql_delete = "DELETE FROM products WHERE product_id = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $product_id);
    if ($stmt_delete->execute()) {
        header("Location: ../admin_product.php");
        echo' <script>alert("xóa thành công");</script>';
        exit();
    } else {
        header("Location: ../admin_product.php");
        echo' <script>alert("xóa thất bại");</script>';
        exit();
    }
} 
?>
