<?php
// Kết nối đến MySQL
$conn = new mysqli("localhost", "root", "", "btj");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Dữ liệu đơn hàng
$don_hang = [
    ['2024-10-01 20:43:00', 1, '0954672157', '89 Lê Lợi, Hải Châu, Đà Nẵng', 0, 'Hoàn thành', ''],
    ['2024-10-09 09:24:00', 2, '0724915976', '78 Đường Lê Lợi, Phường Bến Thành, Quận 1', 0, 'Hoàn thành', 'Giao hàng trong giờ hành chính'],
    ['2024-10-18 03:58:00', 3, '0936452178', '35 Nguyễn Chí Thanh, Thành phố Huế', 30000, 'Hoàn thành', ''],
    ['2024-10-25 18:53:00', 5, '0923456789', '10 Trần Hưng Đạo, Ninh Kiều, Cần Thơ', 30000, 'Đã hủy', ''],
    ['2024-11-05 16:16:00', 6, '0964918527', '42 Nguyễn Huệ, phường Bến Nghé, Quận 1, thành phố Hồ Chí Minh', 0, 'Đã giao cho đơn vị vận chuyển', ''],
    ['2024-11-14 01:18:00', 7, '0764258915', '98 Hoàng Hoa Thám, Ba Đình, Hà Nội', 30000, 'Đã giao cho đơn vị vận chuyển', ''],
    ['2024-11-19 17:11:00', 2, '0724915976', '78 Đường Lê Lợi, Phường Bến Thành, Quận 1', 0, 'Đã chuẩn bị hàng', ''],
    ['2024-11-24 02:53:00', 1, '0954672157', '89 Lê Lợi, Hải Châu, Đà Nẵng', 0, 'Đã chuẩn bị hàng', ''],
    ['2024-11-27 19:36:00', 8, '0901234567', '12 Hùng Vương, Thành phố Nha Trang', 30000, 'Đã hủy', ''],
    ['2024-12-01 14:33:00', 6, '0964918527', '42 Nguyễn Huệ, phường Bến Nghé, Quận 1, thành phố Hồ Chí Minh', 0, 'Đã duyệt', ''],
    ['2024-12-03 23:21:00', 10, '0945678901', '18 Lê Hồng Phong, Quận Ngô Quyền, Hải Phòng', 0, 'Đang chờ duyệt', 'Gói thành hộp quà']
];


// Chuẩn bị câu lệnh SQL để chèn dữ liệu vào cơ sở dữ liệu
$stmt = $conn->prepare("INSERT INTO don_hang (thoi_gian, id_khach_hang, so_dien_thoai_giao_hang, dia_chi_giao_hang, phi_ship, trang_thai, ghi_chu) VALUES (?, ?, ?, ?, ?, ?, ?)");

// Duyệt qua từng đơn hàng và chèn vào cơ sở dữ liệu
foreach ($don_hang as $don) {
    $stmt->bind_param("sissdss", $don[0], $don[1], $don[2], $don[3], $don[4], $don[5], $don[6], );
    $stmt->execute();
}

// Kiểm tra việc chèn dữ liệu
echo "Dữ liệu đơn hàng đã được thêm thành công!";

// Đóng kết nối
$stmt->close();
$conn->close();
?>
