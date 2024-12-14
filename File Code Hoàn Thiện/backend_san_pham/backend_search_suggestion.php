<?php
// Kết nối cơ sở dữ liệu
include "../db_connection.php";

// Lấy giá trị từ request
$query = isset($_GET['query']) ? $_GET['query'] : '';

// Nếu query không trống
if (!empty($query)) {
    // Chuẩn bị câu truy vấn SQL để tìm kiếm sản phẩm gần giống với từ khóa
    $sql = "SELECT ten_san_pham FROM san_pham WHERE ten_san_pham LIKE ? LIMIT 5";
    
    $stmt = $conn->prepare($sql);
    $search_param = "%" . $query . "%"; // Tạo tham số để tìm kiếm gần giống với từ khóa
    $stmt->bind_param("s", $search_param); // Gắn tham số vào câu truy vấn

    $stmt->execute();
    $result = $stmt->get_result();

    $suggestions = [];
    // Lấy kết quả từ truy vấn và trả về dưới dạng JSON
    while ($row = $result->fetch_assoc()) {
        $suggestions[] = $row['ten_san_pham'];
    }

    // Trả về kết quả đề xuất dưới dạng JSON
    echo json_encode($suggestions);
} else {
    // Nếu không có từ khóa, trả về mảng trống
    echo json_encode([]);
}
?>
