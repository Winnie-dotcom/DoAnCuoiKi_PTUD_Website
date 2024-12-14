<?php
include "../db_connection.php";

$query = isset($_GET['query']) ? trim($_GET['query']) : '';

if (!empty($query)) {
    $sql = "SELECT ten_blog FROM blog WHERE ten_blog LIKE ? LIMIT 5";
    $stmt = $conn->prepare($sql);
    $param = "%" . $query . "%";
    $stmt->bind_param("s", $param);
    $stmt->execute();
    $result = $stmt->get_result();

    $suggestions = [];
    while ($row = $result->fetch_assoc()) {
        $suggestions[] = $row['ten_blog'];
    }

    echo json_encode($suggestions);
} else {
    echo json_encode([]);
}
?>
