<?php
function validate_form_data($data) {
    $errors = [];

    // Kiểm tra họ và tên
    if (empty($data['name']) || !preg_match("/^[a-zA-ZÀ-ỹ\s]+$/u", $data['name'])) {
        $errors['name'] = "Họ và tên không hợp lệ. Chỉ cho phép ký tự chữ và khoảng trắng.";
    }

    // Kiểm tra email
    if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email không hợp lệ.";
    }

    // Kiểm tra số điện thoại
    if (empty($data['phone']) || !preg_match("/^[0-9]{10,11}$/", $data['phone'])) {
        $errors['phone'] = "Số điện thoại không hợp lệ. Phải là số và từ 10-11 ký tự.";
    }

    // Kiểm tra địa chỉ
    if (empty($data['address'])) {
        $errors['address'] = "Địa chỉ không được để trống.";
    }

    return $errors;
}
