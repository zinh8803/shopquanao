<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>Chỉnh sửa thông tin</title>
    <style>
        .avatar-preview {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 20px;
        }
        .avatar-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>
<?php 
session_start();
include("web/header.php"); ?>

<div class="container mt-5">
    <?php include("web/banner.php"); ?>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card p-5 shadow">
                <h3 class="text-center mb-4">Chỉnh sửa thông tin</h3>

                <div class="avatar-preview mx-auto mb-4" id="avatarPreview">
                    <img src="" alt="Avatar" id="avatarImage" class="rounded-circle">
                </div>

                <form id="editForm" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="username" class="form-label">Tên người dùng</label>
                            <input type="text" class="form-control" id="username" name="username" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="gender" class="form-label">Giới tính</label>
                            <select id="gender" name="gender" class="form-select">
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                                <option value="Khác">Khác</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Địa chỉ</label>
                        <textarea id="address" name="address" class="form-control" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="avatar" class="form-label">Thay đổi ảnh đại diện</label>
                        <input type="file" class="form-control" id="avatar" name="avatar">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Mật khẩu mới</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="confirm_password" class="form-label">Xác nhận mật khẩu mới</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include("web/footer.php"); ?>
<script src="./js/bootstrap.bundle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Fetch user info and populate form
    fetch("function/get_user.php")
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                document.getElementById("username").value = data.user.username;
                document.getElementById("email").value = data.user.email;
                document.getElementById("gender").value = data.user.gender || "Nam";
                document.getElementById("phone").value = data.user.phone || "";
                document.getElementById("address").value = data.user.address || "";
                document.getElementById("avatarImage").src = data.user.avatar || "image_avata/avatar.png";
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Lỗi",
                    text: data.message || "Không thể tải thông tin người dùng.",
                });
            }
        })
        .catch((error) => {
            console.error("Lỗi:", error);
            Swal.fire({
                icon: "error",
                title: "Lỗi",
                text: "Không thể tải thông tin người dùng.",
            });
        });

    // Handle form submission
    document.getElementById("editForm").addEventListener("submit", function (e) {
        e.preventDefault();
        const formData = new FormData(this);

        fetch("function/update_user.php", {
            method: "POST",
            body: formData,
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Thành công!",
                        text: data.message,
                    }).then(() => location.reload());
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Thất bại!",
                        text: data.message,
                    });
                }
            })
            .catch((error) => {
                console.error("Lỗi:", error);
                Swal.fire({
                    icon: "error",
                    title: "Lỗi!",
                    text: "Có lỗi xảy ra, vui lòng thử lại.",
                });
            });
    });
});
</script>
</body>
</html>
