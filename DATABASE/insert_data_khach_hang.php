<?php
// Kết nối đến MySQL
$conn = new mysqli("localhost", "root", "", "btj");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Dữ liệu khách hàng
$khach_hang = [
    ['Nguyễn Văn Hiếu', 'matkhau123', 'Nam', '2004-09-16', '0954672157', 'hieu.nv@gmail.com', '89 Lê Lợi, Hải Châu, Đà Nẵng', 2],
    ['Trần Thị Ngọc Tuyền', 'matkhau456', 'Nữ', '1999-04-06', '0724915976', 'tuyen.ttn@gmail.com', '78 Đường Lê Lợi, Phường Bến Thành, Quận 1', 2],
    ['Lê Việt Anh', 'matkhau789', 'Nam', '1997-01-29', '0936452178', 'anhle@gmail.com', '35 Nguyễn Chí Thanh, Thành phố Huế', 1],
    ['Lê Thị Hồng Nhung', 'matkhau321', 'Nữ', '2005-05-14', '0912345678', 'nhungle@gmail.com', '77 Đường Hồng Hà, Phường 2, Quận Tân Bình', 0],
    ['Đỗ Thị Thanh Hà', 'matkhau654', 'Nữ', '1998-11-05', '0923456789', 'hathanh89@gmail.com', '10 Trần Hưng Đạo, Ninh Kiều, Cần Thơ', 1],
    ['Huỳnh Văn Nhân', 'matkhau987', 'Nam', '2000-12-10', '0964918527', 'nhan1012@gmail.com', '42 Nguyễn Huệ, phường Bến Nghé, Quận 1, thành phố Hồ Chí Minh', 2],
    ['Đỗ Anh Tuấn', 'matkhau102', 'Nam', '2005-03-31', '0764258915', 'tuanda@gmail.com', '98 Hoàng Hoa Thám, Ba Đình, Hà Nội', 1],
    ['Trần Đức Anh', 'matkhau203', 'Nam', '2002-04-15', '0901234567', 'ducanh154@gmail.com', '12 Hùng Vương, Thành phố Nha Trang', 1],
    ['Trần Văn An', 'matkhau304', 'Nam', '2006-08-22', '0934567890', 'antran.van@gmail.com', '35 Đường Sư Vạn Hạnh, Phường 12, Quận 10', 0],
    ['Phạm Quốc Trung', 'matkhau405', 'Nam', '1998-07-16', '0945678901', 'qtrung88@gmail.com', '18 Lê Hồng Phong, Quận Ngô Quyền, Hải Phòng', 1]
];

// Chuẩn bị câu lệnh SQL để chèn dữ liệu vào cơ sở dữ liệu
$stmt = $conn->prepare("INSERT INTO khach_hang (user_name, mat_khau, ten_khach_hang, gioi_tinh, ngay_sinh, so_dien_thoai, email, dia_chi, so_don_hang) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Duyệt qua từng khách hàng, mã hóa mật khẩu và chèn vào cơ sở dữ liệu
foreach ($khach_hang as $khach_hang) {
    // Mã hóa mật khẩu trước khi lưu
    $hashedPassword = password_hash($khach_hang[1], PASSWORD_BCRYPT);  // $khach_hang[1] là mật khẩu

    // Liên kết các tham số và thực thi câu lệnh
    $stmt->bind_param("sssssssss", $khach_hang[0], $hashedPassword, $khach_hang[0], $khach_hang[2], $khach_hang[3], $khach_hang[4], $khach_hang[5], $khach_hang[6], $khach_hang[7]);
    $stmt->execute();
}

// Kiểm tra việc chèn dữ liệu
echo "Dữ liệu đã được thêm thành công!";

// Đóng kết nối
$stmt->close();
$conn->close();
?>
