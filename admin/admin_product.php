<?php
include("db_connect.php"); 


$sql_ao = "SELECT products.product_id, products.name, products.description, products.price, products.stock_quantity, products.image_url, categories.name AS category_name 
           FROM products 
           INNER JOIN categories ON products.category_id = categories.category_id
           WHERE categories.category_id = 1";
$result_ao = $conn->query($sql_ao);






$sql_quan = "SELECT products.product_id, products.name, products.description, products.price, products.stock_quantity, products.image_url, categories.name AS category_name 
             FROM products 
             INNER JOIN categories ON products.category_id = categories.category_id
             WHERE categories.category_id = 2";
$result_quan = $conn->query($sql_quan);



if (isset($_POST['save_product'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock_quantity = $_POST['stock_quantity'];
    $category_id = $_POST['category_id'];

    $target_dir = "image_product/"; 
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $upload_ok = 1;
    $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "<script>alert('File không phải là ảnh.');</script>";
        $upload_ok = 0;
    }
    if (file_exists($target_file)) {
        echo "<script>alert('Ảnh đã tồn tại.');</script>";
        $upload_ok = 0;
    }
    if ($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg" && $image_file_type != "gif"&& $image_file_type != "jfif") {
        echo "<script>alert('Chỉ chấp nhận file JPG, JPEG, PNG & GIF.');</script>";
        $upload_ok = 0;
    }
    if ($upload_ok == 0) {
        echo "<script>alert('Upload ảnh thất bại.');</script>";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], "../" . $target_file)) { 
            $sql = "INSERT INTO products (name, description, price, stock_quantity, category_id, image_url) 
                    VALUES ('$name', '$description', '$price', '$stock_quantity', '$category_id', '$target_file')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Thêm sản phẩm thành công!');</script>";
                echo "<script>document.getElementById('product-form').reset()</script>";
                echo "<script>window.location.href = 'admin_product.php';</script>";


            } else {
                echo "<script>alert('Lỗi khi thêm sản phẩm: " . $conn->error . "');</script>";
            }
        } else {
            echo "<script>alert('Lỗi khi tải lên ảnh.');</script>";
        }
    }
}








?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
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
        /* Giới hạn chiều cao và cuộn mô tả */
.description {
    max-height: 60px; /* Chiều cao tối đa */
    overflow-y: auto; /* Cuộn nếu vượt quá */
    white-space: pre-wrap; /* Giữ định dạng xuống dòng */
}

/* Căn chỉnh hình ảnh */
.product-image {
    width: 60px;
    height: 60px;
    object-fit: cover; /* Cắt ảnh vừa khung */
    border-radius: 5px; /* Bo góc nhẹ */
    display: block;
    margin: auto;
}

    </style>
</head>
<body>
    <!-- Sidebar -->
    <?php include("includes/sidebar.php"); ?>

    <!-- Nội dung -->
    <div class="content">
        <h1 class="mb-4">Quản lý Sản phẩm</h1>

        <!-- Nút thêm sản phẩm -->
        <div class="d-flex justify-content-end mb-3">
            <button id="addProductButton" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> Thêm sản phẩm
            </button>
        </div>

        <!-- Danh sách sản phẩm -->
        <div class="card mb-4">
        <div class="card mb-4">
        <div class="card-header bg-primary text-white">
    <h4 class="mb-0">Danh sách Áo</h4>
</div>
<div class="card-body">
    <table class="table table-striped">
        <thead>
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Tên sản phẩm</th>
                <th class="text-center">Mô tả</th>
                <th class="text-center">Giá</th>
                <th class="text-center">Số lượng tồn kho</th>
                <th class="text-center">Hình ảnh</th>
                <th class="text-center">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result_ao->num_rows > 0) {
                while ($row = $result_ao->fetch_assoc()) {
            ?>
            <tr>
                <td class="text-center"><?php echo $row['product_id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td class="description"><?php echo $row['description']; ?></td>
                <td class="text-end"><?php echo number_format($row['price'], 0, ',', '.'); ?>đ</td>
                <td class="text-end"><?php echo $row['stock_quantity']; ?></td>
                <td class="text-center">
                    <img src="<?php echo "http://localhost/project_shopquanao/".$row['image_url']; ?>" alt="Product Image" class="product-image">
                </td>
                <td class="text-center">
                    <a href="edit_product.php?product_id=<?php echo $row['product_id']; ?>" class="btn btn-warning btn-sm">
                        <i class="fa-solid fa-pen"></i> Sửa
                    </a>
                    <a href="function/delete_product.php?id=<?php echo $row['product_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');">
                        <i class="fa-solid fa-trash"></i> Xóa
                    </a>
                </td>
            </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='7' class='text-center'>Không có sản phẩm nào.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>


<div class="card mb-4">
    <div class="card-header bg-success text-white">
        <h4 class="mb-0">Danh sách Quần</h4>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Tên sản phẩm</th>
                    <th class="text-center">Mô tả</th>
                    <th class="text-center">Giá</th>
                    <th class="text-center">Số lượng tồn kho</th>
                    <th class="text-center">Hình ảnh</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result_quan->num_rows > 0) {
                    while ($row = $result_quan->fetch_assoc()) {
                ?>
                <tr>
                    <td class="text-center"><?php echo $row['product_id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td class="description"><?php echo $row['description']; ?></td>
                    <td class="text-end"><?php echo number_format($row['price'], 0, ',', '.'); ?>đ</td>
                    <td class="text-end"><?php echo $row['stock_quantity']; ?></td>
                    <td class="text-center">
                        <img src="<?php echo"http://localhost/project_shopquanao/". $row['image_url']; ?>" alt="Product Image" class="product-image">
                    </td>
                    <td class="text-center">
                    <a href="edit_product.php?product_id=<?php echo $row['product_id']; ?>" class="btn btn-warning btn-sm">
                        <i class="fa-solid fa-pen"></i> Sửa
                    </a>
                    <a href="function/delete_product.php?id=<?php echo $row['product_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');">
                        <i class="fa-solid fa-trash"></i> Xóa
                    </a>
                    </td>
                </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>Không có sản phẩm nào.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

        <!-- Form thêm sản phẩm -->
        <div class="card shadow-lg" id="productForm">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0 text-center">Thêm/Sửa Sản phẩm</h4>
    </div>
    <div class="card-body">
        <form id="product-form" action="admin_product.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên sản phẩm" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Nhập mô tả sản phẩm" required></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Giá sản phẩm</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Nhập giá sản phẩm" required>
            </div>
            <div class="mb-3">
                <label for="stock_quantity" class="form-label">Số lượng tồn kho</label>
                <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" placeholder="Nhập số lượng tồn kho" required>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Danh mục</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    <option value="">-- Chọn danh mục --</option>
                    <option value="1">Áo</option>
                    <option value="2">Quần</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh sản phẩm</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" name="save_product" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Lưu</button>
                <button type="button" id="cancelButton" class="btn btn-secondary"><i class="fa-solid fa-xmark"></i> Hủy</button>
            </div>
        </form>
    </div>
</div>


    </div>

    <!-- Script -->
    <script>
        const addProductButton = document.getElementById('addProductButton');
        const productForm = document.getElementById('productForm');
        const cancelButton = document.getElementById('cancelButton');

        addProductButton.addEventListener('click', () => {
            productForm.style.display = 'block';
            addProductButton.style.display = 'none';
        });

        cancelButton.addEventListener('click', () => {
            productForm.style.display = 'none';
            addProductButton.style.display = 'block';
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>

