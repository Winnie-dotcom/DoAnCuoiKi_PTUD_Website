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
$sql = "CREATE TABLE blog (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ten_blog VARCHAR(255) NOT NULL,
    noi_dung TEXT,
    tac_gia VARCHAR(255) NOT NULL, 
    ngay_dang DATE NOT NULL,
    anh VARCHAR(255) DEFAULT NULL
)";

// Thực thi lệnh CREATE TABLE
if ($conn->query($sql) === TRUE) {
    echo "Tạo bảng blog thành công!";
} else {
    echo "Error creating table: " . $conn->error;
}

// Đóng kết nối
$conn->close();
?>