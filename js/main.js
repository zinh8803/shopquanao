function validateForm() {
    var name = document.getElementById("name").value.trim();
    var phone = document.getElementById("phone").value.trim();
    var email = document.getElementById("email").value.trim();
    var service1 = document.getElementById("service1").checked;
    var service2 = document.getElementById("service2").checked;
    var service3 = document.getElementById("service3").checked;
    var errorMessage = "";


    if (name === "") {
        errorMessage += "Vui lòng nhập Họ Tên.\n";
    }

    if (phone === "") {
        errorMessage += "Vui lòng nhập Số Điện Thoại.\n";
    }
    if (email === "") {
        errorMessage += "Vui lòng nhập Email.\n";
    } else {
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            errorMessage += "Vui lòng nhập Email hợp lệ.\n";
        }
    }
    if (!service1 && !service2 && !service3) {
        errorMessage += "Vui lòng chọn ít nhất một Dịch Vụ.\n";
    }
    if (errorMessage !== "") {
        alert(errorMessage);
        return false;
    }
    alert("Gửi thành công");
    return true;
}

document.addEventListener("DOMContentLoaded", function() {
    var submitButton = document.querySelector(".btn_pricing");
    submitButton.addEventListener("click", function(event) {
        if (!validateForm()) {
            event.preventDefault();
        }
    });
});
