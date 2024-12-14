<?php
include '../db_connection.php';
include '../kiem_tra_dang_nhap.php';

if ($isLoggedIn == NULL) {
    echo "<script>
        alert('Vui lòng đăng nhập trước khi mua hàng!');
        window.history.back();
    </script>";
}
else {
$id_khach_hang = $_SESSION['id']; // Lấy id khách hàng từ session
// Lấy dữ liệu từ POST
$id_san_pham = isset($_POST['id_san_pham']) ? intval($_POST['id_san_pham']) : 0;
$so_luong = isset($_POST['so_luong']) ? intval($_POST['so_luong']) : 1;

// Kiểm tra dữ liệu hợp lệ
if ($id_san_pham <= 0 || $so_luong <= 0) {
    echo "<script>alert('Dữ liệu không hợp lệ!'); window.history.back();</script>";
    exit;
}

// Thêm sản phẩm vào bảng gio_hang
$sql = "INSERT INTO gio_hang (id_khach_hang, id_san_pham, so_luong) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("iii", $id_khach_hang, $id_san_pham, $so_luong);

    if ($stmt->execute()) {
        echo "<script>
        alert ('Sản phẩm đã được thêm để thanh toán');
        location.href = '../xac_nhan_don_hang/xac_nhan_don_hang.php';</script>";
    } else {
        echo "<script>alert('Không thể thêm sản phẩm!'); window.history.back();</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('Lỗi kết nối cơ sở dữ liệu!'); window.history.back();</script>";
}

$conn->close();
} 
?>