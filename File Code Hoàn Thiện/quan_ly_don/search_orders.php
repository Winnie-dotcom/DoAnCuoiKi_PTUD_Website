<?php
// Kết nối đến cơ sở dữ liệu
include "../db_connection.php";

// Kiểm tra xem người dùng có nhập từ khóa tìm kiếm không
if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];

    // Truy vấn tìm kiếm chỉ dựa trên mã đơn (id)
    $sql = "
        SELECT 
            dh.id, 
            dh.thoi_gian, 
            dh.trang_thai,
            SUM(CAST(ctdh.so_luong AS DECIMAL) * CAST(sp.gia_ban AS DECIMAL)) AS tong_hoa_don
        FROM don_hang dh
        JOIN chi_tiet_don_hang ctdh ON dh.id = ctdh.id_don_hang
        JOIN san_pham sp ON ctdh.id_san_pham = sp.id
        WHERE dh.id LIKE ?   -- Tìm kiếm chỉ dựa trên mã đơn hàng (id)
        GROUP BY dh.id, dh.thoi_gian, dh.trang_thai
    ";

    // Sử dụng câu lệnh chuẩn bị để tránh SQL injection
    $stmt = $conn->prepare($sql);
    $searchTerm = "%" . $keyword . "%"; // Thêm % để tìm kiếm theo kiểu LIKE
    $stmt->bind_param("s", $searchTerm); // Liên kết tham số tìm kiếm (chỉ cần một tham số vì tìm kiếm theo id)

    // Thực thi truy vấn
    $stmt->execute();

    // Lấy kết quả truy vấn
    $result = $stmt->get_result();
} else {
    $result = null;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm đơn hàng</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="order-management">
  <div class="layout-container">
  <nav class="sidebar">
      <div class="sidebar-content">
        <div class="brand-logo">        
          <img src="logo.png" alt="LOGO">
        </div>
        <a href="../backend_san_pham/backend_san_pham.php" class="nav-item active">
          <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/0f4878f968496374dde71db3b5d3b48e430aea5cbbbdc17b9a992c9073fb1cee?placeholderIfAbsent=true&apiKey=c0a07ac21f1245ca94f2e7b6c096677c" alt="" class="nav-icon" />
          <span>Sản phẩm</span>
        </a>

        <a href="quan_ly_don.php" class="nav-item active">
            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/1c4b3f665eeda4c2ab2f7e632528ede89cf7b3a39a7275aa728d85e9e91a6f1c?placeholderIfAbsent=true&apiKey=c0a07ac21f1245ca94f2e7b6c096677c" alt="" class="nav-icon" />
            <span>Đơn hàng</span>
        </a>

        <a href="../backend_blog/backend_blog.php" class="nav-item active">
          <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/a8316a1beb845c0fe71d332c7010dfc91f2adc0b9b26cf5a419663ee2cc5510a?placeholderIfAbsent=true&apiKey=c0a07ac21f1245ca94f2e7b6c096677c" alt="" class="nav-icon" />
          <span>Bài viết</span>
        </a>

        <a href="../dang_xuat/dang_xuat_admin.php" class="nav-item active">
          <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/170996ea976592f23f0dc12558b6946a7ce322f5ecff2f0a0341da620be554d6?placeholderIfAbsent=true&apiKey=c0a07ac21f1245ca94f2e7b6c096677c" alt="" class="nav-icon" />
          <span>Đăng xuất</span>
        </a>
      </div>
    </nav>

    <main class="main-content">
      <h1 class="page-title">Đơn hàng</h1>

<!-- Thanh tìm kiếm -->

<div class="container">
  <form class="search-container" role="search" method="GET" action="search_orders.php">
    <div class="search-form">
      <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/e7d1e978b0cf9046d93201057d022743e85881919990416da6dca5c2f6f756b2?placeholderIfAbsent=true&apiKey=c0a07ac21f1245ca94f2e7b6c096677c" alt="Search icon" class="nav-icon">
      <input type="search" name="keyword" placeholder="Tìm kiếm mã đơn hàng" value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>">
    <!-- Giữ lại các tham số lọc -->
    <input type="hidden" name="status" value="<?= isset($_GET['status']) ? $_GET['status'] : '' ?>">
    <input type="hidden" name="start_date" value="<?= isset($_GET['start_date']) ? $_GET['start_date'] : '' ?>">
    <input type="hidden" name="end_date" value="<?= isset($_GET['end_date']) ? $_GET['end_date'] : '' ?>">      <button type="submit" class="search-button">
        <span class="vertical-divider" aria-hidden="true"></span>
        <span>Tìm kiếm</span>
      </button>
    </div>
  </form>
  <div class="filter-container">
  <div class="filter-button">
    <img
      loading="lazy"
      src="https://cdn.builder.io/api/v1/image/assets/TEMP/95fdcc8eb54f3cebbaa8f171ecfef381de5e89194c456dd7ac7c6fbc11dc174d?placeholderIfAbsent=true&apiKey=c0a07ac21f1245ca94f2e7b6c096677c"
      class="filter-icon"
      alt="Filter"
    />
  </div>

  <div class="filter-dropdown">
    <form method="GET" action="search_orders.php">
      <!-- Lọc theo trạng thái -->
 <label for="status">Trạng thái:</label>
 <select name="status">
        <option value="">Tất cả trạng thái</option>
        <option value="Đang chờ duyệt" <?= isset($_GET['status']) && $_GET['status'] === 'Đang chờ duyệt' ? 'selected' : '' ?>>Đang chờ duyệt</option>
        <option value="Đã duyệt" <?= isset($_GET['status']) && $_GET['status'] === 'Đã duyệt' ? 'selected' : '' ?>>Đã duyệt</option>
        <option value="Đã chuẩn bị hàng" <?= isset($_GET['status']) && $_GET['status'] === 'Đã chuẩn bị hàng' ? 'selected' : '' ?>>Đã chuẩn bị hàng</option>
        <option value="Đã giao cho đơn vị vận chuyển" <?= isset($_GET['status']) && $_GET['status'] === 'Đã giao cho đơn vị vận chuyển' ? 'selected' : '' ?>>Đã giao cho đơn vị vận chuyển</option>
        <option value="Đã hủy" <?= isset($_GET['status']) && $_GET['status'] === 'Đã hủy' ? 'selected' : '' ?>>Đã hủy</option>
        <option value="Hoàn thành" <?= isset($_GET['status']) && $_GET['status'] === 'Hoàn thành' ? 'selected' : '' ?>>Hoàn thành</option>
    
      </select>

    <!-- Lọc khoảng thời gian -->
    <input type="date" name="start_date" value="<?= isset($_GET['start_date']) ? $_GET['start_date'] : '' ?>">
    <input type="date" name="end_date" value="<?= isset($_GET['end_date']) ? $_GET['end_date'] : '' ?>">
    <!-- Giữ lại tham số tìm kiếm -->
    <input type="hidden" name="keyword" value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>">
      <!-- Nút áp dụng -->
      <button type="submit" class="apply-filter-button">Áp dụng</button>
  </form>
</div>
</div>
</div>

<div class="orders-container">
    <table class="order-table">
      <thead> 
        <tr>
          <th>Mã đơn</th>
          <th>Ngày tạo đơn</th>
          <th>Trạng thái</th>
          <th>Tổng hóa đơn</th>
          <th> </th>
          <th> </th>
        </tr>
      </thead>
      <tbody>
        <?php

// Khởi tạo mảng điều kiện và tham số
$where = [];
$params = [];
$types = "";

// Tìm kiếm theo từ khóa
if (!empty($_GET['keyword'])) {
    $where[] = "dh.id LIKE ?";
    $params[] = "%" . $_GET['keyword'] . "%";
    $types .= "s";
}

// Lọc theo trạng thái
if (!empty($_GET['status'])) {
    $where[] = "dh.trang_thai = ?";
    $params[] = $_GET['status'];
    $types .= "s";
}

// Lọc theo khoảng thời gian
if (!empty($_GET['start_date'])) {
    $where[] = "DATE(dh.thoi_gian) >= ?";
    $params[] = $_GET['start_date'];
    $types .= "s";
}
if (!empty($_GET['end_date'])) {
    $where[] = "DATE(dh.thoi_gian) <= ?";
    $params[] = $_GET['end_date'];
    $types .= "s";
}

// Tạo câu lệnh WHERE
$where_sql = $where ? "WHERE " . implode(" AND ", $where) : "";

// Câu truy vấn chính
$sql = "
    SELECT 
        dh.id, 
        dh.thoi_gian, 
        dh.trang_thai,
        SUM(CAST(ctdh.so_luong AS DECIMAL) * CAST(sp.gia_ban AS DECIMAL)) AS tong_hoa_don
    FROM don_hang dh
    JOIN chi_tiet_don_hang ctdh ON dh.id = ctdh.id_don_hang
    JOIN san_pham sp ON ctdh.id_san_pham = sp.id
    $where_sql
    GROUP BY dh.id, dh.thoi_gian, dh.trang_thai
";

// Chuẩn bị và thực thi truy vấn
$stmt = $conn->prepare($sql);
if ($params) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result(); ?>


<?php if ($result && $result->num_rows > 0): ?>
  <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
          <td>#<?= htmlspecialchars($row['id']) ?></td>
          <td><?= date('d/m/Y - H:i', strtotime($row['thoi_gian'])) ?></td>
          <td><?= htmlspecialchars($row['trang_thai']) ?></td>
          <td><?= number_format($row['tong_hoa_don'], 0, ',', '.') ?> ₫</td>
      
<?php          echo "<td class='actions'>
            <img src='https://cdn.builder.io/api/v1/image/assets/TEMP/ca999df985736f586fac2b2e4987433f1fa96f07ae33b872c7cc0a8fc788f34d' alt='Edit' class='action-icon' />
          </td>";
    echo "<td class='actions'>
          <img src='https://cdn.builder.io/api/v1/image/assets/TEMP/5161f1b2687398c0022ed4fa1935eb4f484e79abf11b4ae7601cf8a43c20e96d' 
               alt='Delete' 
               class='action-icon' 
               onclick='showConfirmBox(" . $row['id'] . ")' />
        </td>";
?>
        </tr>
  <?php endwhile; ?>
<?php else: ?>
  <tr>
      <td colspan="4">Không tìm thấy kết quả phù hợp.</td>
  </tr>
<?php endif; ?>
</body>
</table>
  </div>
</body>
</html>

<?php
// Đóng kết nối
$conn->close();
?>
