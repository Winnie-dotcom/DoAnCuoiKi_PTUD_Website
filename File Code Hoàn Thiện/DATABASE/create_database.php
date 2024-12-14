<?php
// Thông tin kết nối MySQL
$servername = "localhost";
$username = "root"; // Thay đổi nếu bạn sử dụng username khác
$password = ""; // Thay đổi nếu bạn có mật khẩu cho MySQL

// Tạo kết nối
$conn = new mysqli($servername, $username, $password);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Tên cơ sở dữ liệu
$databaseName = "btj";

// Tạo cơ sở dữ liệu
$sql = "CREATE DATABASE $databaseName";
if ($conn->query($sql) === TRUE) {
    echo "Tạo cơ sở dữ liệu thành công: $databaseName";
} else {
    echo "Lỗi khi tạo cơ sở dữ liệu: " . $conn->error;
}

// Đóng kết nối
$conn->close();
?>