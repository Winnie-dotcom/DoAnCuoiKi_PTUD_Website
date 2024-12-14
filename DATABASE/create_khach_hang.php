<?php
// Kết nối tới cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "btj"; // Tên cơ sở dữ liệu

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Lệnh CREATE TABLE
$sql = "CREATE TABLE khach_hang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(255) NOT NULL,
    mat_khau VARCHAR(255) NOT NULL,
    ten_khach_hang VARCHAR(255) NOT NULL, 
    gioi_tinh ENUM('Nam', 'Nữ') NOT NULL, 
    ngay_sinh DATE NOT NULL, 
    so_dien_thoai VARCHAR(10) NOT NULL, 
    email VARCHAR(255),
    dia_chi TEXT,
    so_don_hang INT DEFAULT 0 NOT NULL
)";

// Thực thi lệnh CREATE TABLE
if ($conn->query($sql) === TRUE) {
    echo "Tạo bảng khach_hang thành công!";
} else {
    echo "Error creating table: " . $conn->error;
}

// Đóng kết nối
$conn->close();
?>
