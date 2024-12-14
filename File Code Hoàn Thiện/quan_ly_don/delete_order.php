<?php
// Kết nối đến cơ sở dữ liệu
include "../db_connection.php";

// Kiểm tra nếu id được truyền qua URL
if (isset($_GET['id'])) {
    $orderId = $_GET['id'];

    // Xóa chi tiết đơn hàng trước
    $sqlChiTiet = "DELETE FROM chi_tiet_don_hang WHERE id_don_hang = ?";
    $stmtChiTiet = $conn->prepare($sqlChiTiet);
    $stmtChiTiet->bind_param("i", $orderId);

    if ($stmtChiTiet->execute()) {
        // Nếu xóa chi tiết thành công, xóa đơn hàng
        $sqlDonHang = "DELETE FROM don_hang WHERE id = ?";
        $stmtDonHang = $conn->prepare($sqlDonHang);
        $stmtDonHang->bind_param("i", $orderId);

        if ($stmtDonHang->execute()) {
            echo "<script>alert('Xóa đơn hàng thành công!'); window.location.href = 'quan_ly_don.php';</script>";
        } else {
            echo "<script>alert('Có lỗi xảy ra khi xóa đơn hàng.'); window.location.href = 'quan_ly_don.php';</script>";
        }

        $stmtDonHang->close();
    } else {
        echo "<script>alert('Có lỗi xảy ra khi xóa chi tiết đơn hàng.'); window.location.href = 'quan_ly_don.php';</script>";
    }

    $stmtChiTiet->close();
} else {
    echo "<script>alert('Không tìm thấy mã đơn hàng.'); window.location.href = 'quan_ly_don.php';</script>";
}

// Đóng kết nối
$conn->close();
?>
