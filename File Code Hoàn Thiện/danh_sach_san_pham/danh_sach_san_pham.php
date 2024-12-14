<?php
require_once '../db_connection.php'; // Kết nối database

// Lấy danh mục sản phẩm và từ khóa tìm kiếm từ URL
$category = isset($_GET['category']) ? trim($_GET['category']) : '';
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Tạo truy vấn SQL với điều kiện tìm kiếm và danh mục
$sql = "SELECT * FROM san_pham WHERE 1"; // "1" là placeholder để thêm điều kiện sau
$params = [];
$types = "";

if (!empty($category)) {
    $sql .= " AND phan_loai = ?";
    $params[] = $category;
    $types .= "s";
}
if (!empty($search)) {
    $sql .= " AND ten_san_pham LIKE ?";
    $params[] = "%" . $search . "%";
    $types .= "s";
}

// Chuẩn bị và thực thi truy vấn
$stmt = $conn->prepare($sql);
if ($params) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

// Lưu dữ liệu sản phẩm vào mảng
$mang_san_pham = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $mang_san_pham[] = $row;
    }
}

// Đóng statement và kết nối
$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="SP_2.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm</title>
    <script src="chon_mua.js" defer> </script>
</head>

<?php
include "../kiem_tra_dang_nhap.php";
if ($isLoggedIn == NULL) {
  include_once "../header_footer/header/chua_login.php";
}
else {
  include_once "../header_footer/header/da_login.php";
}
?>

<div class="container_body">
    <!-- banner -->
    <div class="banner">
            <img src="banner.jpg" alt="banner" id="anh_banner">
    </div>

    <div class="container">
            <form class="search-container" role="search" method="get" action="">
    <input type="hidden" name="category" value="<?= htmlspecialchars($category) ?>">
    <div class="search-form">
        <input type="search" name="search" id="search-input" class="search-input" placeholder="Tìm kiếm sản phẩm" value="<?= htmlspecialchars($search) ?>">
        <button type="submit" class="search-button">Tìm kiếm</button>
    </div>
</form>

    </div>

    <div class="product">
    <!-- Điều hướng danh mục -->
    <nav class="category-nav" role="navigation">
        <a href="?category=nhan" class="danh_muc <?= $category === 'nhan' ? 'active-category' : '' ?>">Nhẫn</a>
        <a href="?category=vong co" class="danh_muc <?= $category === 'vong co' ? 'active-category' : '' ?>">Vòng cổ</a>
        <a href="?category=hoa tai" class="danh_muc <?= $category === 'hoa tai' ? 'active-category' : '' ?>">Hoa tai</a>
        <a href="?category=vong tay" class="danh_muc <?= $category === 'vong tay' ? 'active-category' : '' ?>">Vòng tay</a>
    </nav>

    <?php if (!empty($mang_san_pham)) { ?>
    <div class="product-grid">
        <?php foreach ($mang_san_pham as $san_pham) {
            $san_pham_url = htmlspecialchars("../chi_tiet_san_pham/chi_tiet_san_pham.php?id=" . $san_pham['id']);
            ?>
            <div class="product-container" onclick="window.location.href='<?= $san_pham_url; ?>'">
                <img src="../anh/<?= htmlspecialchars($san_pham['anh_minh_hoa']); ?>" class="product-image" alt="<?= htmlspecialchars($san_pham['ten_san_pham']); ?>">
                <div class="product-info">
                    <div class="product-title">
                        <?= htmlspecialchars($san_pham['ten_san_pham']); ?>
                    </div>
                    <div class="product-price">
                        <?= number_format($san_pham['gia_ban'], 0, ',', '.'); ?> đ
                    </div>
                </div>
                <button class="add-to-cart" onclick="event.stopPropagation(); payment(<?php echo $san_pham['id']; ?>)">
                    Mua ngay
                </button>
            </div>
        <?php } ?>
    </div>
<?php } else { ?>
    <div class="no-products-message">
        <p>Không tìm thấy sản phẩm nào.</p>
    </div>
<?php } ?>



</div>
</div>
    
<?php 
include "../header_footer/footer/footer.php"
?>
</html>