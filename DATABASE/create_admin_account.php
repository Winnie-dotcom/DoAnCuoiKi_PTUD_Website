<?php
// Kết nối đến MySQL
$conn = new mysqli("localhost", "root", "", "btj");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Câu lệnh SQL để tạo bảng admin_account
$sql = "CREATE TABLE admin_account (
    username VARCHAR(50) NOT NULL PRIMARY KEY,
    password VARCHAR(255) NOT NULL
)";

// Thực thi câu lệnh
if ($conn->query($sql) === TRUE) {
    echo "Bảng admin_account đã được tạo thành công!";
} else {
    echo "Lỗi khi tạo bảng: " . $conn->error;
}

// Đóng kết nối
$conn->close();
?>
