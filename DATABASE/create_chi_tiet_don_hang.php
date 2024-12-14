<?php
$servername = "localhost"; // Địa chỉ server MySQL
$username = "root"; // Tên người dùng MySQL
$password = ""; // Mật khẩu MySQL
$dbname = "btj"; // Tên cơ sở dữ liệu

// Kết nối đến MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Câu lệnh tạo bảng chi_tiet_don_hang
$sql = "CREATE TABLE chi_tiet_don_hang (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Mã chi tiết
    id_don_hang INT NOT NULL, -- Khóa ngoại tham chiếu đến bảng don_hang
    id_san_pham INT NOT NULL, -- Khóa ngoại tham chiếu đến bảng san_pham
    ten_san_pham VARCHAR(255), -- Tên sản phẩm
    so_luong INT NOT NULL CHECK (so_luong > 0), -- Số lượng sản phẩm
    FOREIGN KEY (id_don_hang) REFERENCES don_hang(id), -- Khóa ngoại bảng don_hang
    FOREIGN KEY (id_san_pham) REFERENCES san_pham(id) -- Khóa ngoại bảng san_pham
)";

// Thực thi câu lệnh tạo bảng
if ($conn->query($sql) === TRUE) {
    echo "Tạo bảng chi_tiet_don_hang thành công!";
} else {
    echo "Lỗi khi tạo bảng: " . $conn->error;
}

// Đóng kết nối
$conn->close();
?>
