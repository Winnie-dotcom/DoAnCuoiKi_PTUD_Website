<?php
// Kết nối đến MySQL
$conn = new mysqli("localhost", "root", "", "btj");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Thông tin tài khoản admin
$username = "admin_btj";
$password = "BTJ123";

// Mã hóa mật khẩu
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// Câu lệnh SQL để chèn dữ liệu vào bảng admin_account
$stmt = $conn->prepare("INSERT INTO admin_account (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hashedPassword);

// Thực thi câu lệnh
if ($stmt->execute()) {
    echo "Tài khoản admin đã được thêm thành công!";
} else {
    echo "Lỗi khi thêm tài khoản admin: " . $stmt->error;
}

// Đóng kết nối
$stmt->close();
$conn->close();
?>
