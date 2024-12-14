<?php
session_start(); 
include("./data_connect/db.php");

if (isset($_GET['remove'])) {
    $product_id = (int)$_GET['remove'];
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
    header("Location: cart.php");
    exit();
}

if (isset($_GET['clear'])) {
    unset($_SESSION['cart']); 
    header("Location: cart.php");
    exit();
}

if (isset($_POST['action']) && $_POST['action'] === 'update_quantity') {
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];

    if ($quantity > 0) {
        $sql_stock = "SELECT stock_quantity, price FROM products WHERE product_id = :product_id";
        $stmt_stock = $conn->prepare($sql_stock);
        $stmt_stock->execute([':product_id' => $product_id]);

        $product = $stmt_stock->fetch(PDO::FETCH_ASSOC);
        if ($product) {
            $stock_quantity = $product['stock_quantity'];
            $price = $product['price'];

            if ($quantity > $stock_quantity) {
                echo json_encode([
                    'error' => "Số lượng yêu cầu vượt quá tồn kho (chỉ còn {$stock_quantity} sản phẩm)."
                ]);
                exit();
            } else {
                $_SESSION['cart'][$product_id] = $quantity;

                // Tính toán subtotal và total
                $subtotal = $price * $quantity;
                $total = 0;
                foreach ($_SESSION['cart'] as $id => $qty) {
                    $sql_price = "SELECT price FROM products WHERE product_id = :product_id";
                    $stmt_price = $conn->prepare($sql_price);
                    $stmt_price->execute([':product_id' => $id]);
                    $row = $stmt_price->fetch(PDO::FETCH_ASSOC);
                    $total += $row['price'] * $qty;
                }

                echo json_encode(['subtotal' => $subtotal, 'total' => $total]);
            }
        }
    }
    exit();
}


if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $product_ids = array_keys($_SESSION['cart']);
    $placeholders = implode(',', array_fill(0, count($product_ids), '?'));
    $sql = "SELECT product_id, name, description, price, image_url FROM products WHERE product_id IN ($placeholders)";
    $stmt = $conn->prepare($sql);
    $stmt->execute($product_ids);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="./fonts/fontawesome-free-6.5.2-web/fontawesome-free-6.5.2-web/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">    

    <title>Giỏ hàng</title>
</head>
<body>
<style>
    .content {
        background-color: #f8f9fa;
        min-height: calc(100vh - 200px);
    }
</style>

<?php include("web/header.php"); ?>


<div class="container mt-5">
<?php include("./web/banner.php"); ?>
    <h2 class="text-center">Giỏ hàng của bạn</h2>

    <?php if (!empty($result)): ?>
        <div class="table-responsive">
        <table class="table table-bordered">
    <thead>
        <tr>
            <th>Hình ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Đơn giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $total = 0;
        foreach ($result as $row):
            $product_id = $row['product_id'];
            $name = $row['name'];
            $price = $row['price'];
            $image_url = $row['image_url'];
            $quantity = $_SESSION['cart'][$product_id];
            $subtotal = $price * $quantity;
            $total += $subtotal;
        ?>
        <tr id="product-<?php echo $product_id; ?>">
            <td><img src="<?php echo $image_url; ?>" alt="<?php echo $name; ?>" style="width: 100px;"></td>
            <td><?php echo $name; ?></td>
            <td><?php echo number_format($price, 0, ',', '.'); ?>đ</td>
            <td>
                <input type="number" class="form-control text-center update-quantity" style="width: 100px;" min="1" value="<?php echo $quantity; ?>" data-id="<?php echo $product_id; ?>">
            </td>
            <td class="subtotal"><?php echo number_format($subtotal, 0, ',', '.'); ?>đ</td>
            <td>
                <button class="btn btn-sm btn-danger remove-product" data-id="<?php echo $product_id; ?>">Xóa</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <?php
        $vat_rate = 0.08; // 8% VAT
        $vat_amount = $total * $vat_rate;
        $total_with_vat = $total + $vat_amount;
        ?>
        <tr>
            <td colspan="4" class="text-end"><strong>Tạm tính:</strong></td>
            <td colspan="2" id="subtotal"><strong><?php echo number_format($total, 0, ',', '.'); ?>đ</strong></td>
        </tr>
        <tr>
            <td colspan="4" class="text-end"><strong>VAT (8%):</strong></td>
            <td colspan="2" id="vat"><strong><?php echo number_format($vat_amount, 0, ',', '.'); ?>đ</strong></td>
        </tr>
        <tr>
            <td colspan="4" class="text-end"><strong>Tổng cộng:</strong></td>
            <td colspan="2" id="total-with-vat"><strong><?php echo number_format($total_with_vat, 0, ',', '.'); ?>đ</strong></td>
        </tr>
    </tfoot>
</table>

        </div>
        <div class="text-end">
        <a href="checkout.php" class="btn btn-primary">Thanh toán</a>
            <button class="btn btn-danger clear-cart">Xóa toàn bộ giỏ hàng</button>
            <a href="index.php" class="btn btn-secondary">Tiếp tục mua sắm</a>
        </div>
    <?php else: ?>
        <p class="text-center">Giỏ hàng của bạn hiện tại trống.</p>
        <div class="text-center">
            <a href="index.php" class="btn btn-primary">Tiếp tục mua sắm</a>
        </div>
    <?php endif; ?>
</div>

<?php include("web/footer.php"); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $(".update-quantity").on("change", function () {
            const productId = $(this).data("id");
            const quantity = $(this).val();

            if (quantity < 1) {
                alert("Số lượng phải lớn hơn 0");
                return;
            }

            $.ajax({
                url: "cart.php",
                method: "POST",
                data: {
                    action: "update_quantity",
                    product_id: productId,
                    quantity: quantity
                },
                dataType: "json",
                success: function (response) {
                    if (response.error) {
                        alert(response.error);
                    } else {
                        $(`#product-${productId} .subtotal`).text(new Intl.NumberFormat().format(response.subtotal) + "đ");
                        $("#cart-total").text(new Intl.NumberFormat().format(response.total) + "đ");
                    }
                },
                error: function () {
                    alert("Có lỗi xảy ra!");
                }
            });
        });
    });
    $(document).ready(function () {
     
        // Xóa sản phẩm
        $(".remove-product").on("click", function () {
            const productId = $(this).data("id");
            Swal.fire({
                title: "Bạn có chắc chắn?",
                text: "Sản phẩm này sẽ bị xóa khỏi giỏ hàng!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Xóa",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.get("cart.php?remove=" + productId, function (response) {
                        location.reload();
                    });
                }
            });
        });

        // Xóa toàn bộ giỏ hàng
        $(".clear-cart").on("click", function () {
            Swal.fire({
                title: "Bạn có chắc chắn?",
                text: "Toàn bộ sản phẩm sẽ bị xóa khỏi giỏ hàng!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Xóa tất cả",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.get("cart.php?clear=true", function (response) {
                        location.reload();
                    });
                }
            });
        });
        // Cập nhật số lượng sản phẩm
        $(".update-quantity").on("change", function () {
            const productId = $(this).data("id");
            const quantity = $(this).val();

            if (quantity < 1) {
                Swal.fire({
                    icon: "error",
                    title: "Lỗi",
                    text: "Số lượng phải lớn hơn 0.",
                });
                return;
            }

            $.ajax({
                url: "cart.php",
                method: "POST",
                data: {
                    action: "update_quantity",
                    product_id: productId,
                    quantity: quantity
                },
                dataType: "json",
                success: function (response) {
                    if (response.error) {
                        Swal.fire({
                            icon: "error",
                            title: "Lỗi",
                            text: response.error,
                        });
                    } else {
                        $(`#product-${productId} .subtotal`).text(new Intl.NumberFormat().format(response.subtotal) + "đ");
                        $("#cart-total").text(new Intl.NumberFormat().format(response.total) + "đ");
                        Swal.fire({
                            icon: "success",
                            title: "Cập nhật thành công!",
                            text: "Số lượng sản phẩm đã được cập nhật.",
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: "error",
                        title: "Lỗi",
                        text: "Có lỗi xảy ra khi cập nhật số lượng.",
                    });
                }
            });
        });

     

    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="./js/bootstrap.bundle.js"></script>
</body>
</html>
