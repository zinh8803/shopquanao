<?php
include("./data_connect/db.php");
session_start();

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    try {
        $sql = "SELECT * FROM products WHERE product_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$product_id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            echo "<script>alert('Không tìm thấy sản phẩm!'); window.location.href = 'index.php';</script>";
            exit();
        }
    } catch (PDOException $e) {
        die("Lỗi truy vấn: " . $e->getMessage());
    }
} else {
    echo "<script>alert('Không có thông tin sản phẩm!'); window.location.href = 'index.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <title>Chi tiết sản phẩm</title>
</head>
<body>
<?php include("web/header.php"); ?>
<div class="container">
<?php include("web/banner.php"); ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <img src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['name']; ?>" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h1><?php echo $product['name']; ?></h1>
            <p class="text-muted"><?php echo number_format($product['price'], 0, ',', '.'); ?>đ</p>
            <p><?php echo $product['description']; ?></p>
            <?php if ($product['stock_quantity'] > 0): ?>
                        <button class="btn btn-primary add-to-cart" data-id="<?php echo $product['product_id']; ?>">Thêm vào giỏ hàng</button>
                    <?php else: ?>
                        <button class="btn btn-secondary" disabled>Hết hàng</button>
                    <?php endif; ?>
        </div>
    </div>
</div>

</div>

<?php include("web/footer.php"); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $(".add-to-cart").on("click", function () {
            const productId = $(this).data("id");

            $.ajax({
                url: "cart_handler.php",
                method: "POST",
                data: { product_id: productId },
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        alert(response.message);
                        $(".shopping .badge").text(response.cart_count);
                    } else {
                        alert(response.message);
                    }
                },
                error: function () {
                    alert("Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng.");
                }
            });
        });
    });
</script>
<script src="./js/bootstrap.bundle.js"></script>
</body>
</html>
