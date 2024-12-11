<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <!-- Tiêu đề -->
        <h2 class="text-center mb-4"><i class="fa-solid fa-box-open"></i> Quản lý Sản phẩm</h2>

        <!-- Form thêm/sửa sản phẩm -->
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0 text-center">Thêm/Sửa Sản phẩm</h4>
            </div>
            <div class="card-body">
                <form action="admin_product_handler.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên sản phẩm" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Mô tả</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Nhập mô tả sản phẩm" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Giá</label>
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
                            <option value="1">Áo khoác</option>
                            <option value="2">Quần</option>
                            <option value="3">Giày</option>
                            <!-- Thêm danh mục khác từ database -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="image_url" class="form-label">Hình ảnh sản phẩm</label>
                        <input type="file" class="form-control" id="image_url" name="image_url" required>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" name="save_product" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Lưu</button>
                        <a href="admin_product.php" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
