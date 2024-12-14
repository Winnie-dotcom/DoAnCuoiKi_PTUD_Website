<?php
include "../db_connection.php";
// Truy vấn dữ liệu từ bảng don_hang và chi_tiet_don_hang
$sql = "
    SELECT 
        dh.id, 
        dh.thoi_gian, 
        dh.trang_thai, 
    SUM(CAST(ctdh.so_luong AS DECIMAL) * CAST(sp.gia_ban AS DECIMAL)) AS tong_hoa_don    FROM don_hang dh
    JOIN chi_tiet_don_hang ctdh ON dh.id = ctdh.id_don_hang
    JOIN san_pham sp ON ctdh.id_san_pham = sp.id
    GROUP BY dh.id, dh.thoi_gian, dh.trang_thai
";

// Thực thi truy vấn
$result = $conn->query($sql);

// Đóng kết nối
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đơn hàng</title>
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

<!-- Bảng dữ liệu -->
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
    // Kiểm tra xem có dữ liệu trả về không
if ($result->num_rows > 0) {
  // Xuất dữ liệu ra bảng
  while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>#". $row['id'] . "</td>";
    echo "<td>". date('d/m/Y - H:i', strtotime($row['thoi_gian'])) . "</td>"; // Định dạng lại ngày giờ
    echo "<td>". $row['trang_thai'] . "</td>";
    echo "<td>". number_format($row['tong_hoa_don'], 0, ',', '.') . " ₫</td>"; // Định dạng giá tiền
    echo "<td class='actions'>
    <a href='edit_don_hang.php?id={$row['id']}'>
        <img src='https://cdn.builder.io/api/v1/image/assets/TEMP/ca999df985736f586fac2b2e4987433f1fa96f07ae33b872c7cc0a8fc788f34d' alt='Edit' class='action-icon' />
    </a>
  </td>";

    echo "<td class='actions'>
          <img src='https://cdn.builder.io/api/v1/image/assets/TEMP/5161f1b2687398c0022ed4fa1935eb4f484e79abf11b4ae7601cf8a43c20e96d' 
               alt='Delete' 
               class='action-icon' 
               onclick='showConfirmBox(" . $row['id'] . ")' />
        </td>";
  
    echo "</tr>";
  }
} else {
  echo "Không có dữ liệu.";
}
?>
    </tbody>
  </table>
</div>

    </main>
  </div>
</div>
<script>
  function showConfirmBox(orderId) {
    const isConfirmed = confirm("Bạn có chắc chắn muốn xóa đơn hàng #" + orderId + " không?");
    if (isConfirmed) {
      // Chuyển hướng đến trang xóa với id đơn hàng
      window.location.href = "delete_order.php?id=" + orderId;
    }
  }
</script>

</body>