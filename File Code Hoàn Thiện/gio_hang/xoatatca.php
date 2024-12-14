<?php
session_start();
include "../db_connection.php"; // Kết nối với cơ sở dữ liệu

$id_khach_hang = $_SESSION['id']; // Lấy id khách hàng từ session

// Xoá tất cả sản phẩm trong giỏ hàng của khách hàng
$sql = "DELETE FROM gio_hang WHERE id_khach_hang = '$id_khach_hang'";

if ($conn->query($sql) === TRUE) {
    // Chuyển hướng lại trang giỏ hàng sau khi xoá thành công
    header("Location: gio_hang.php");
} else {
    echo "Lỗi: " . $conn->error;
}
?>
