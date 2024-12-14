<?php
include "../db_connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    if ($id > 0) {
        // Xóa trong bảng chi_tiet_don_hang trước
        $stmtChiTiet = $conn->prepare("DELETE FROM chi_tiet_don_hang WHERE id_san_pham = ?");
        $stmtChiTiet->bind_param("i", $id);

        if ($stmtChiTiet->execute()) {
            $stmtChiTiet->close();

            // Xóa trong bảng san_pham
            $stmt = $conn->prepare("DELETE FROM san_pham WHERE id = ?");
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Sản phẩm đã được xóa.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Lỗi khi xóa sản phẩm.']);
            }

            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'Lỗi khi xóa chi tiết đơn hàng: ' . $stmtChiTiet->error]);
            $stmtChiTiet->close();
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID sản phẩm không hợp lệ.']);
    }

    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Yêu cầu không hợp lệ.']);
}
?>