<?php
include("./data_connect/db.php");
session_start();

try {
    $sql_ao = "SELECT product_id, name, description, price,stock_quantity, image_url FROM products WHERE category_id = 1";
    $stmt_ao = $conn->prepare($sql_ao);
    $stmt_ao->execute();
    $result_ao = $stmt_ao->fetchAll(PDO::FETCH_ASSOC);

    $sql_quan = "SELECT product_id, name, description, price,stock_quantity, image_url FROM products WHERE category_id = 2";
    $stmt_quan = $conn->prepare($sql_quan);
    $stmt_quan->execute();
    $result_quan = $stmt_quan->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Lỗi truy vấn: " . $e->getMessage());
}


$category_filter = $_GET['category'] ?? null;
$price_min = $_GET['price_min'] ?? null;
$price_max = $_GET['price_max'] ?? null;
$search_query = $_GET['search'] ?? null;

$query = "SELECT product_id, name, description, price, stock_quantity, image_url FROM products WHERE 1=1";
$params = [];

if ($category_filter) {
    $query .= " AND category_id = ?";
    $params[] = $category_filter;
}

if (!empty($price_min)) {
    $query .= " AND price >= ?";
    $params[] = $price_min;
}
if (!empty($price_max)) {
    $query .= " AND price <= ?";
    $params[] = $price_max;
}


if ($search_query) {
    $query .= " AND name LIKE ?";
    $params[] = "%" . $search_query . "%";
}

try {
    $stmt = $conn->prepare($query);
    $stmt->execute($params);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Lỗi truy vấn: " . $e->getMessage());
}


$sql_categories = "SELECT category_id, name FROM categories";
$stmt_categories = $conn->prepare($sql_categories);
$stmt_categories->execute();
$categories = $stmt_categories->fetchAll(PDO::FETCH_ASSOC);

$category_filter = isset($_GET['category']) ? $_GET['category'] : '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <title>Sản phẩm</title>
</head>
<body>
<style>
.card {
    width: 12rem;
    margin: 15px auto; 
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
    transition: all 0.3s ease-in-out;
}

.card:hover {
    transform: translateY(-5px); 
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2); 
}

.card img {
    width: 100%; 
    height: auto; 
    object-fit: cover;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.card-body h5.card-title {
    font-size: 0.9rem; 
    text-align: center;
    color: #333;
    margin-bottom: 5px;
}

.card-body p.card-text {
    font-size: 0.85rem;
    text-align: center;
    color: #888;
    margin-bottom: 10px;
}

.card-body .btn {
    font-size: 0.85rem;
    padding: 5px 8px; 
    display: block;
    margin: 0 auto; 
}


</style>
    <!-- Menu -->
    <?php
    include("web/header.php"); ?>

    <div class="container">
    <?php include("./web/banner.php"); ?>
    <h2 class="text-center mt-4">Sản phẩm</h2>

    <div class="row">
        <div class="col-md-3">
            <h5 class="mb-3">Bộ lọc</h5>
            <form method="GET" action="services.php">
                <div class="mb-3">
                    <label for="category" class="form-label">Danh mục</label>
                    <select id="category" name="category" class="form-select">
    <option value="">Tất cả</option>
    <?php foreach ($categories as $category): ?>
        <option value="<?php echo htmlspecialchars($category['category_id']); ?>" 
                <?php echo $category_filter == $category['category_id'] ? 'selected' : ''; ?>>
            <?php echo htmlspecialchars($category['name']); ?>
        </option>
    <?php endforeach; ?>
</select>

                </div>
                <div class="mb-3">
                    <label for="price_min" class="form-label">Giá từ</label>
                    <input type="number" id="price_min" name="price_min" class="form-control" placeholder="VND" value="<?php echo htmlspecialchars($price_min); ?>">
                </div>
                <div class="mb-3">
                    <label for="price_max" class="form-label">Đến</label>
                    <input type="number" id="price_max" name="price_max" class="form-control" placeholder="VND" value="<?php echo htmlspecialchars($price_max); ?>">
                </div>
                <button type="submit" class="btn btn-primary w-100">Lọc</button>
            </form>
        </div>

        <!-- Danh sách sản phẩm -->
        <div class="col-md-9">
            <div class="row">
                <?php if (empty($products)): ?>
                    <p class="text-center">Không tìm thấy sản phẩm nào!</p>
                <?php else: ?>
                    <?php foreach ($products as $product): ?>
                        <div class="col-md-4 col-sm-6 mb-4">
                            <div class="card h-100">
                                <a href="product_detail.php?product_id=<?php echo $product['product_id']; ?>" class="text-decoration-none text-dark">
                                    <img src="<?php echo $product['image_url']; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                                        <p class="card-text"><?php echo number_format($product['price'], 0, ',', '.'); ?>đ</p>
                                    </div>
                                </a>
                                <?php if ($product['stock_quantity'] > 0): ?>
                                    <button class="btn btn-primary add-to-cart" data-id="<?php echo $product['product_id']; ?>">Thêm vào giỏ hàng</button>
                                <?php else: ?>
                                    <button class="btn btn-secondary" disabled>Hết hàng</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
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
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công!',
                        text: response.message,
                        timer: 2000, 
                        showConfirmButton: true
                    });
                    $(".shopping .badge").text(response.cart_count);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi!',
                        text: response.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: 'Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng.',
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        });
    });
});

    </script>
      <script src="./js/bootstrap.bundle.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>
