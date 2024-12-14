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

// Câu lệnh tạo bảng don_hang
$sql = "CREATE TABLE don_hang (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Mã đơn hàng
    thoi_gian DATETIME DEFAULT CURRENT_TIMESTAMP, -- Ngày giờ tạo đơn
    id_khach_hang INT NOT NULL, -- Khóa ngoại tham chiếu đến bảng khach_hang
    so_dien_thoai_giao_hang VARCHAR(15), -- Số điện thoại giao hàng
    dia_chi_giao_hang VARCHAR(255), -- Địa chỉ giao hàng
    phi_ship DECIMAL(10, 2) DEFAULT 30000, -- Phí ship mặc định
    trang_thai ENUM('Đang chờ duyệt', 'Đã duyệt', 'Đã chuẩn bị hàng', 
                    'Đã giao cho đơn vị vận chuyển', 'Đã hủy', 'Hoàn thành') 
                DEFAULT 'Đang chờ duyệt', -- Trạng thái đơn hàng
    ghi_chu TEXT, -- Ghi chú của khách hàng
    FOREIGN KEY (id_khach_hang) REFERENCES khach_hang(id) -- Khóa ngoại bảng khach_hang
)";

// Thực thi câu lệnh tạo bảng
if ($conn->query($sql) === TRUE) {
    echo "Tạo bảng don_hang thành công!";
} else {
    echo "Lỗi khi tạo bảng: " . $conn->error;
}

// Đóng kết nối
$conn->close();
?>
