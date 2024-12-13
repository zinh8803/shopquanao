<?php
include("db_connect.php");

if (isset($_GET['product_id'])) {
    $product_id = (int)$_GET['product_id'];

    try {
        $sql = "SELECT * FROM products WHERE product_id = :product_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            echo "<script>alert('Không tìm thấy sản phẩm!'); window.location.href = 'admin_product.php';</script>";
            exit();
        }
    } catch (PDOException $e) {
        echo "<script>alert('Lỗi hệ thống: {$e->getMessage()}'); window.location.href = 'admin_product.php';</script>";
        exit();
    }
}

if (isset($_POST['update_product'])) {
    $product_id = (int)$_POST['product_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock_quantity = $_POST['stock_quantity'];
    $category_id = $_POST['category_id'];

    try {
        $sql_get_product = "SELECT * FROM products WHERE product_id = :product_id";
        $stmt_get_product = $conn->prepare($sql_get_product);
        $stmt_get_product->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt_get_product->execute();

        $product = $stmt_get_product->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            echo "<script>alert('Không tìm thấy sản phẩm!'); window.location.href = 'admin_product.php';</script>";
            exit();
        }

        if (!empty($_FILES['image']['name'])) {
            $target_dir = "image_product/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["image"]["tmp_name"]);

            if ($check === false) {
                echo "<script>alert('File không phải là ảnh!');</script>";
                exit();
            }
            if (!in_array($image_file_type, ['jpg', 'jpeg', 'png', 'gif', 'jfif', 'webp'])) {
                echo "<script>alert('Chỉ chấp nhận file JPG, JPEG, PNG & GIF!');</script>";
                exit();
            }

            if (!empty($product['image_url']) && file_exists("../" . $product['image_url'])) {
                unlink("../" . $product['image_url']);
            }

            if (move_uploaded_file($_FILES["image"]["tmp_name"], "../" . $target_file)) {
                $image_url = $target_file;
            } else {
                echo "<script>alert('Lỗi khi tải lên ảnh mới!');</script>";
                exit();
            }
        } else {
            $image_url = $product['image_url'];
        }

        $sql_update = "UPDATE products 
                       SET name = :name, description = :description, price = :price, stock_quantity = :stock_quantity, 
                           image_url = :image_url, category_id = :category_id 
                       WHERE product_id = :product_id";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt_update->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt_update->bindParam(':price', $price, PDO::PARAM_STR);
        $stmt_update->bindParam(':stock_quantity', $stock_quantity, PDO::PARAM_INT);
        $stmt_update->bindParam(':image_url', $image_url, PDO::PARAM_STR);
        $stmt_update->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $stmt_update->bindParam(':product_id', $product_id, PDO::PARAM_INT);

        if ($stmt_update->execute()) {
            echo "<script>alert('Cập nhật sản phẩm thành công!'); window.location.href = 'admin_product.php';</script>";
        } else {
            echo "<script>alert('Lỗi khi cập nhật sản phẩm!');</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Lỗi hệ thống: {$e->getMessage()}');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sản phẩm</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>
<body>
<style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            min-width: 240px;
            background-color: #343a40;
            height: 100vh;
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
        }
        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
            padding: 10px;
            display: block;
        }
        .sidebar a:hover {
            background-color: #495057;
            color: #fff;
        }
        .content {
            margin-left: 260px;
            padding: 20px;
        }
        #productForm {
            display: none;
        }
      
.description {
    max-height: 60px; 
    overflow-y: auto; 
    white-space: pre-wrap; 
}


.product-image {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 5px;
    display: block;
    margin: auto;
}

    </style>
     <?php include("includes/sidebar.php"); ?>
     <div class="content">
    <div class="container mt-5">
        <h2 class="text-center">Sửa Sản phẩm</h2>
        <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $product['name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $product['description']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Giá</label>
                <input type="number" class="form-control" id="price" name="price" value="<?php echo $product['price']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="stock_quantity" class="form-label">Số lượng tồn kho</label>
                <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" value="<?php echo $product['stock_quantity']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Danh mục</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    <option value="1" <?php echo $product['category_id'] == 1 ? 'selected' : ''; ?>>Áo</option>
                    <option value="2" <?php echo $product['category_id'] == 2 ? 'selected' : ''; ?>>Quần</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh sản phẩm</label>
                <input type="file" class="form-control" id="image" name="image">
                <img src="../<?php echo $product['image_url']; ?>" alt="Product Image" style="width: 100px; margin-top: 10px;">
            </div>
            <button type="submit" name="update_product" class="btn btn-primary">Cập nhật</button>
            <a href="admin_product.php" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
    </div>
</body>
</html>
