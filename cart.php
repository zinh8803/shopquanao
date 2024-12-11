<?php
session_start(); // Khởi tạo session
include("./data_connect/db.php");

// Xử lý xóa sản phẩm khỏi giỏ hàng
if (isset($_GET['remove'])) {
    $product_id = (int)$_GET['remove'];
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]); // Xóa sản phẩm khỏi giỏ hàng
    }
    header("Location: cart.php");
    exit();
}

// Xử lý xóa toàn bộ giỏ hàng
if (isset($_GET['clear'])) {
    unset($_SESSION['cart']); // Xóa toàn bộ giỏ hàng
    header("Location: cart.php");
    exit();
}

// Xử lý cập nhật số lượng sản phẩm trong giỏ hàng qua AJAX
if (isset($_POST['action']) && $_POST['action'] === 'update_quantity') {
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];

    if ($quantity > 0) {
        // Kiểm tra stock_quantity từ cơ sở dữ liệu
        $sql_stock = "SELECT stock_quantity, price FROM products WHERE product_id = ?";
        $stmt_stock = $conn->prepare($sql_stock);
        $stmt_stock->bind_param("i", $product_id);
        $stmt_stock->execute();
        $result_stock = $stmt_stock->get_result();

        if ($result_stock->num_rows > 0) {
            $product = $result_stock->fetch_assoc();
            $stock_quantity = $product['stock_quantity'];
            $price = $product['price'];

            if ($quantity > $stock_quantity) {
                echo json_encode([
                    'error' => "Số lượng yêu cầu vượt quá tồn kho (chỉ còn {$stock_quantity} sản phẩm)."
                ]);
                exit();
            } else {
                $_SESSION['cart'][$product_id] = $quantity;

                // Tính tổng tiền của sản phẩm và giỏ hàng
                $subtotal = $price * $quantity;
                $total = 0;
                foreach ($_SESSION['cart'] as $id => $qty) {
                    $sql_price = "SELECT price FROM products WHERE product_id = ?";
                    $stmt_price = $conn->prepare($sql_price);
                    $stmt_price->bind_param("i", $id);
                    $stmt_price->execute();
                    $result_price = $stmt_price->get_result();
                    $row = $result_price->fetch_assoc();
                    $total += $row['price'] * $qty;
                }

                echo json_encode(['subtotal' => $subtotal, 'total' => $total]);
            }
        }
    }
    exit();
}

// Kiểm tra nếu giỏ hàng có sản phẩm
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $product_ids = array_keys($_SESSION['cart']);
    $ids = implode(',', $product_ids);
    $sql = "SELECT product_id, name, description, price, image_url FROM products WHERE product_id IN ($ids)";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <title>Giỏ hàng</title>
</head>
<body>
<style>
    .content {
        background-color: #f8f9fa;
        min-height: calc(100vh - 200px); /* Để footer không bị tràn lên */
    }
</style>

<?php include("web/header.php"); ?>
<?php include("./web/banner.php"); ?>

<div class="container mt-5">
    <h2 class="text-center">Giỏ hàng của bạn</h2>

    <?php if (isset($result) && $result->num_rows > 0): ?>
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
                    while ($row = $result->fetch_assoc()):
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
                            <a href="?remove=<?php echo $product_id; ?>" class="btn btn-sm btn-danger">Xóa</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-end"><strong>Tổng cộng:</strong></td>
                        <td colspan="2" id="cart-total"><strong><?php echo number_format($total, 0, ',', '.'); ?>đ</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="text-end">
            <a href="checkout.php" class="btn btn-primary">Thanh toán</a>
            <a href="?clear=true" class="btn btn-danger">Xóa toàn bộ giỏ hàng</a>
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
</script>
</body>
</html>
