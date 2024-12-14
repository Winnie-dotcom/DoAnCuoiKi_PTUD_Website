<?php
include "../db_connection.php"; // Kết nối đến database

// SQL để tạo bảng gio_hang
$sql = "
    CREATE TABLE gio_hang (
        id INT AUTO_INCREMENT PRIMARY KEY,
        id_khach_hang INT,
        id_san_pham INT,
        so_luong INT,
        FOREIGN KEY (id_khach_hang) REFERENCES khach_hang(id),
        FOREIGN KEY (id_san_pham) REFERENCES san_pham(id)
    );
";

// Thực thi câu lệnh SQL
if ($conn->query($sql) === TRUE) {
    echo "Bảng gio_hang đã được tạo thành công.";
} else {
    echo "Lỗi: " . $conn->error;
}

// Đóng kết nối
$conn->close();
?>
