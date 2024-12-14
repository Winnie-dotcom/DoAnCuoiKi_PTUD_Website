<?php
session_start();
include "../db_connection.php"; // Kết nối với cơ sở dữ liệu

$id_khach_hang = $_SESSION['id']; // Lấy id khách hàng từ session
$id_san_pham = $_GET['id']; // Lấy id sản phẩm từ URL

// Xoá sản phẩm theo id
$sql = "DELETE FROM gio_hang WHERE id_khach_hang = '$id_khach_hang' AND id_san_pham = '$id_san_pham'";

if ($conn->query($sql) === TRUE) {
    // Chuyển hướng lại trang giỏ hàng sau khi xoá thành công
    header("Location: gio_hang.php");
} else {
    echo "Lỗi: " . $conn->error;
}
?>
