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
$sql = "CREATE TABLE san_pham (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ten_san_pham VARCHAR(100) NOT NULL,
    phan_loai VARCHAR(100) NOT NULL,
    gia_ban INT NOT NULL,
    so_luong_trong_kho VARCHAR(20) NOT NULL,
    mo_ta_san_pham TEXT,
    anh_minh_hoa VARCHAR(300)
  )";

// Thực thi lệnh CREATE TABLE
if ($conn->query($sql) === TRUE) {
    echo "Tạo bảng san_pham thành công!";
} else {
    echo "Error creating table: " . $conn->error;
}

// Đóng kết nối
$conn->close();
?>
