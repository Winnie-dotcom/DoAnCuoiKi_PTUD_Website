<?php
include "../db_connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    if ($id > 0) {
        $stmt = $conn->prepare("DELETE FROM blog WHERE id = ?");
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Bài viết đã được xóa.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Lỗi khi xóa bài viết.']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'ID bài viết không hợp lệ.']);
    }

    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Yêu cầu không hợp lệ.']);
}
?>
