<?php
session_start();
include("./data_connect/db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "Giỏ hàng trống!";
    exit;
}

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$address = $_POST['address'] ?? '';
$total_price = 0;
$cart_details = [];

// Tính toán giỏ hàng
foreach ($_SESSION['cart'] as $product_id => $quantity) {
    $sql = "SELECT product_id, name, price FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        $product['quantity'] = $quantity; 
        $product['total_price'] = $product['price'] * $quantity;
        $cart_details[] = $product; 
        $total_price += $product['total_price']; 
    }
}

if (empty($cart_details)) {
    echo "Giỏ hàng trống hoặc sản phẩm không tồn tại!";
    exit;
}

include("function/kiemtra.php"); // Import file kiểm tra dữ liệu

// Biến lưu lỗi
$errors = [];

// Kiểm tra dữ liệu đầu vào
$errors = validate_form_data([
    'name' => $name,
    'email' => $email,
    'phone' => $phone,
    'address' => $address
]);

if (empty($errors)) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $vat_rate = 0.08; // VAT 8%
        $vat_amount = $total_price * $vat_rate;
        $final_total = $total_price + $vat_amount; // Tổng giá trị sau VAT

        try {
            $conn->beginTransaction();

            // Tạo đơn hàng
            $sql_order = "INSERT INTO orders (user_id, customer_name, email, address, phone, total_price, created_at) 
                          VALUES (?, ?, ?, ?, ?, ?, NOW())";
            $stmt_order = $conn->prepare($sql_order);
            $stmt_order->execute([$_SESSION['user_id'] ?? null, $name, $email, $address, $phone, $final_total]);

            $order_id = $conn->lastInsertId();

            // Lưu chi tiết đơn hàng
            foreach ($cart_details as $item) {
                if (!isset($item['product_id'])) {
                    throw new Exception("Dữ liệu sản phẩm không hợp lệ!");
                }

                $sql_order_item = "INSERT INTO order_items (order_id, product_id, quantity, price) 
                                   VALUES (?, ?, ?, ?)";
                $stmt_order_item = $conn->prepare($sql_order_item);
                $stmt_order_item->execute([$order_id, $item['product_id'], $item['quantity'], $item['price']]);

                // Giảm tồn kho
                $sql_update_stock = "UPDATE products SET stock_quantity = stock_quantity - ? WHERE product_id = ?";
                $stmt_update_stock = $conn->prepare($sql_update_stock);
                $stmt_update_stock->execute([$item['quantity'], $item['product_id']]);
            }

            $conn->commit();
            unset($_SESSION['cart']);
            header("Location: index.php?success=1");
            exit;
        } catch (Exception $e) {
            $conn->rollBack();
            echo "Lỗi khi xử lý thanh toán: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="./fonts/fontawesome-free-6.5.2-web/fontawesome-free-6.5.2-web/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">    
    <title>Thanh toán</title>
</head>
<body>
<style>
    /* Style cho các ô nhập liệu */
    .form-control, .form-select, textarea {
        border: 1px solid #ced4da; /* Màu viền xám nhạt */
        border-radius: 4px; /* Bo tròn viền */
        padding: 10px; /* Tăng khoảng cách trong */
        box-shadow: none; /* Loại bỏ bóng */
        transition: border-color 0.3s ease-in-out;
    }

    /* Hiệu ứng khi hover */
    .form-control:hover, .form-select:hover, textarea:hover {
        border-color: #80bdff; /* Màu viền khi hover */
    }

    /* Hiệu ứng khi focus */
    .form-control:focus, .form-select:focus, textarea:focus {
        border-color: #80bdff; /* Màu viền khi focus */
        outline: none; /* Loại bỏ viền mặc định */
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25); /* Hiệu ứng bóng khi focus */
    }
</style>

    <!-- menu -->
    <?php include("web/header.php"); ?>

    <!-- nội dung chính -->
    <div class="content">
        <div class="container">
            <!-- banner -->
            <?php include("./web/banner.php"); ?>

            <div class="container mt-5">
    <h2 class="text-center mb-4">Giỏ hàng của bạn</h2>
    <table class="table table-bordered table-hover text-center">
        <thead class="table-dark">
        <tr>
            <th>Sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Tổng</th>
        </tr>
        </thead>
        <tbody>
        <?php 
        $vat_rate = 0.08; // 8% VAT
        $subtotal = 0;

        foreach ($cart_details as $item): 
            $item_total = $item['price'] * $item['quantity'];
            $subtotal += $item_total;
        ?>
            <tr>
                <td><?php echo htmlspecialchars($item['name']); ?></td>
                <td><?php echo number_format($item['price'], 0, ',', '.'); ?>đ</td>
                <td><?php echo $item['quantity']; ?></td>
                <td><?php echo number_format($item_total, 0, ',', '.'); ?>đ</td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3" class="text-end"><strong>Tạm tính:</strong></td>
            <td><strong><?php echo number_format($subtotal, 0, ',', '.'); ?>đ</strong></td>
        </tr>
        <tr>
            <td colspan="3" class="text-end"><strong>VAT (8%):</strong></td>
            <td><strong><?php echo number_format($subtotal * $vat_rate, 0, ',', '.'); ?>đ</strong></td>
        </tr>
        <tr>
            <td colspan="3" class="text-end"><strong>Tổng cộng:</strong></td>
            <td><strong><?php echo number_format($subtotal + ($subtotal * $vat_rate), 0, ',', '.'); ?>đ</strong></td>
        </tr>
        </tbody>
    </table>

    <h3 class="text-center mb-4">Thông tin khách hàng</h3>
    <form method="post"  class="needs-validation" novalidate>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="name" class="form-label">Họ và tên</label>
            <input type="text" 
                   class="form-control <?php echo isset($errors['name']) ? 'is-invalid' : ''; ?>" 
                   id="name" name="name" 
                   placeholder="Nhập họ và tên" 
                   value="<?php echo htmlspecialchars($name ?? ''); ?>" required>
            <?php if (isset($errors['name'])): ?>
                <div class="invalid-feedback"><?php echo $errors['name']; ?></div>
            <?php endif; ?>
        </div>
        <div class="col-md-6 mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" 
                   class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>" 
                   id="email" name="email" 
                   placeholder="Nhập email" 
                   value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
            <?php if (isset($errors['email'])): ?>
                <div class="invalid-feedback"><?php echo $errors['email']; ?></div>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="phone" class="form-label">Số điện thoại</label>
            <input type="text" 
                   class="form-control <?php echo isset($errors['phone']) ? 'is-invalid' : ''; ?>" 
                   id="phone" name="phone" 
                   placeholder="Nhập số điện thoại" 
                   value="<?php echo htmlspecialchars($phone ?? ''); ?>" required>
            <?php if (isset($errors['phone'])): ?>
                <div class="invalid-feedback"><?php echo $errors['phone']; ?></div>
            <?php endif; ?>
        </div>
        <div class="col-md-6 mb-3">
            <label for="address" class="form-label">Địa chỉ</label>
            <textarea id="address" name="address" 
                      class="form-control <?php echo isset($errors['address']) ? 'is-invalid' : ''; ?>" 
                      rows="2" placeholder="Nhập địa chỉ" required><?php echo htmlspecialchars($address ?? ''); ?></textarea>
            <?php if (isset($errors['address'])): ?>
                <div class="invalid-feedback"><?php echo $errors['address']; ?></div>
            <?php endif; ?>
        </div>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-success btn-lg px-5">Thanh toán</button>
    </div>
</form>


</div>

            
        </div>
    </div>

    <!-- footer -->
    <?php include("web/footer.php"); ?>
  
    <script src="./js/bootstrap.bundle.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        // Lấy tất cả các input, textarea
        const inputs = document.querySelectorAll(".form-control");

        inputs.forEach(input => {
            // Khi người dùng focus vào trường nhập liệu
            input.addEventListener("focus", function () {
                this.classList.remove("is-invalid");
                const invalidFeedback = this.nextElementSibling;
                if (invalidFeedback && invalidFeedback.classList.contains("invalid-feedback")) {
                    invalidFeedback.style.display = "none";
                }
            });

            // Khi người dùng bắt đầu nhập dữ liệu
            input.addEventListener("input", function () {
                this.classList.remove("is-invalid");
                const invalidFeedback = this.nextElementSibling;
                if (invalidFeedback && invalidFeedback.classList.contains("invalid-feedback")) {
                    invalidFeedback.style.display = "none";
                }
            });
        });
    });
</script>


</body>
</html>

