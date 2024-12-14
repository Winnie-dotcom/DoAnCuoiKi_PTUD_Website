<?php
include('../db_connection.php');

// Lấy dữ liệu danh mục từ bảng san_pham (cột phan_loai)
$query = "SELECT DISTINCT phan_loai FROM san_pham";
$result = $conn->query($query);

if (!$result) {
    die("Lỗi khi truy vấn danh mục: " . $conn->error);
}

// Kiểm tra nếu có dữ liệu gửi lên và xử lý
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $name = $_POST['product_name'];
    $price = $_POST['product_price'];
    $stock = $_POST['product_stock'];
    $description = $_POST['product_description'];
    $category = $_POST['category']; // Lấy giá trị danh mục đã chọn

   // Xử lý upload ảnh
    if (!empty($_FILES['product_image']['name'])) {
        $imageName = time() . '_' . $_FILES['product_image']['name'];
        move_uploaded_file($_FILES['product_image']['tmp_name'], "../anh/$imageName");
    } else {
        // Lấy tên ảnh hiện tại từ input ẩn
        $imageName = $_POST['current_image'];
    }

    // Cập nhật sản phẩm vào cơ sở dữ liệu
    $query = "UPDATE san_pham SET ten_san_pham = ?, gia_ban = ?, so_luong_trong_kho = ?, mo_ta_san_pham = ?, anh_minh_hoa = ?, phan_loai = ? WHERE id = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Lỗi khi chuẩn bị truy vấn: " . $conn->error);
    }

    $stmt->bind_param("siissii", $name, $price, $stock, $description, $imageName, $category, $id);

    if ($stmt->execute()) {
        // Cập nhật thành công, hiển thị thông báo
        echo "<script>alert('Cập nhật sản phẩm thành công!'); window.location.href = 'backend_san_pham.php';</script>";
    } else {
        die("Lỗi khi cập nhật sản phẩm: " . $stmt->error);
    }
} else {
    die("Yêu cầu không hợp lệ.");
}
if (isset($_POST['category']) && !empty($_POST['category'])) {
    $phan_loai = htmlspecialchars($_POST['category']);
} else {
    die("Danh mục không hợp lệ.");
}

// Tiếp tục xử lý cập nhật...
$query = "UPDATE san_pham SET phan_loai = ? WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("si", $phan_loai, $id);
// Thực thi câu lệnh
$stmt->execute();

?>
