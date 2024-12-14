<?php
include "../db_connection.php"; // Kết nối đến database

// Dữ liệu cần thêm vào bảng gio_hang
$data = [
    [1, 4, 2],  
    [2, 3, 1], 
    [2, 8, 1]   
];

// Chuẩn bị câu lệnh SQL để thêm dữ liệu
$stmt = $conn->prepare("INSERT INTO gio_hang (id_khach_hang, id_san_pham, so_luong) VALUES (?, ?, ?)");

foreach ($data as $row) {
    // Gán giá trị từ mảng dữ liệu vào câu lệnh chuẩn bị
    $stmt->bind_param("iii", $row[0], $row[1], $row[2]); // "iii" vì các tham số đều là số nguyên

    // Thực thi câu lệnh SQL để thêm dữ liệu vào bảng
    if ($stmt->execute()) {
        echo "Dữ liệu đã được thêm thành công.<br>";
    } else {
        echo "Lỗi: " . $stmt->error . "<br>";
    }
}

// Đóng kết nối
$stmt->close();
$conn->close();
?>
