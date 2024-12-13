

<?php
include("db_connect.php");
session_start();

// Thêm danh mục mới
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_category'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];

    if (!empty($name)) {
        $sql_add = "INSERT INTO categories (name, description) VALUES (?, ?)";
        $stmt_add = $conn->prepare($sql_add);
        $stmt_add->execute([$name, $description]);
        header("Location: categories.php");
        exit;
    } else {
        $error = "Tên danh mục không được để trống.";
    }
}

// Xóa danh mục
if (isset($_GET['delete'])) {
    $category_id = (int)$_GET['delete'];

    try {
        $conn->beginTransaction(); 
        $sql_delete_products = "DELETE FROM products WHERE category_id = ?";
        $stmt_delete_products = $conn->prepare($sql_delete_products);
        $stmt_delete_products->execute([$category_id]);

        // Xóa danh mục
        $sql_delete_category = "DELETE FROM categories WHERE category_id = ?";
        $stmt_delete_category = $conn->prepare($sql_delete_category);
        $stmt_delete_category->execute([$category_id]);

        $conn->commit(); // Hoàn tất transaction
        header("Location: categories.php?success=category_deleted");
    } catch (Exception $e) {
        $conn->rollBack(); // Hoàn tác nếu có lỗi
        header("Location: categories.php?error=" . urlencode($e->getMessage()));
    }
    exit;
}


// Hiển thị danh mục
$sql = "SELECT * FROM categories ORDER BY category_id ASC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);



$edit_category = null;
if (isset($_GET['edit'])) {
    $category_id = (int)$_GET['edit'];
    $sql_edit = "SELECT * FROM categories WHERE category_id = ?";
    $stmt_edit = $conn->prepare($sql_edit);
    $stmt_edit->execute([$category_id]);
    $edit_category = $stmt_edit->fetch(PDO::FETCH_ASSOC);
}




// Xử lý cập nhật danh mục
if (isset($_POST['update_category'])) {
    $category_id = (int)$_POST['category_id'];
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);

    if (!empty($name) && !empty($description)) {
        try {
            $sql_update = "UPDATE categories SET name = ?, description = ? WHERE category_id = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->execute([$name, $description, $category_id]);

            header("Location: categories.php?success=Category updated successfully");
        } catch (Exception $e) {
            echo "<div class='alert alert-danger'>Lỗi: " . $e->getMessage() . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Tên danh mục và mô tả không được để trống!</div>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <title>Document</title>
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
            margin-left: 240px;
            padding: 20px;
        }
    </style>
<?php include("includes/sidebar.php"); ?>
<div class="content">
<div class="container mt-5">
    <h2 class="text-center">Quản lý danh mục</h2>

    <!-- Hiển thị danh mục -->
    <table class="table table-bordered table-hover mt-3">
    <thead class="table-danger">
        <tr background-color="">
            <th class="text-center">ID</th>
            <th class="text-center">Tên danh mục</th>
            <th class="text-center">Mô tả</th>
            <th class="text-center">Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($categories)): ?>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <td class="text-center"><?php echo $category['category_id']; ?></td>
                    <td><?php echo htmlspecialchars($category['name']); ?></td>
                    <td class="text-wrap"><?php echo htmlspecialchars($category['description']); ?></td>
                    <td class="text-center">
                        <a href="?edit=<?php echo $category['category_id']; ?>" class="btn btn-warning btn-sm">
                            <i class="fa-solid fa-edit"></i> Sửa
                        </a>
                        <a href="?delete=<?php echo $category['category_id']; ?>" class="btn btn-danger btn-sm" 
                           onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');">
                            <i class="fa-solid fa-trash-alt"></i> Xóa
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" class="text-center">Không có danh mục nào.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

    <?php if ($edit_category): ?>
    <div class="card mt-4">
        <div class="card-header bg-primary text-white">
            <h4>Sửa danh mục</h4>
        </div>
        <div class="card-body">
            <form method="post" action="categories.php">
                <input type="hidden" name="category_id" value="<?php echo htmlspecialchars($edit_category['category_id']); ?>">

                <div class="mb-3">
                    <label for="name" class="form-label">Tên danh mục</label>
                    <input type="text" class="form-control" id="name" name="name" 
                           value="<?php echo htmlspecialchars($edit_category['name']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Mô tả</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required><?php echo htmlspecialchars($edit_category['description']); ?></textarea>
                </div>

                <button type="submit" name="update_category" class="btn btn-primary">Cập nhật</button>
                <a href="categories.php" class="btn btn-secondary">Hủy</a>
            </form>
        </div>
    </div>
    <?php endif; ?>
    <!-- Thêm danh mục -->
    <h3 class="mt-4">Thêm danh mục mới</h3>
    <form method="post" class="mt-3">
        <div class="mb-3">
            <label for="name" class="form-label">Tên danh mục</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên danh mục" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea class="form-control" id="description" name="description" rows="2" placeholder="Nhập mô tả"></textarea>
        </div>
        <button type="submit" name="add_category" class="btn btn-success">Thêm danh mục</button>
        <?php if (isset($error)): ?>
            <div class="text-danger mt-2"><?php echo $error; ?></div>
        <?php endif; ?>
    </form>
</div>
<script src="./js/bootstrap.bundle.js"></script>


    </div>
</body>
</html>