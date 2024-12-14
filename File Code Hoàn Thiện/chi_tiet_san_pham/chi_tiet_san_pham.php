<?php
include '../db_connection.php';
include 'best_seller.php';


// Lấy id_san_pham từ URL
if (isset($_GET['id'])) {
  $id_san_pham = intval($_GET['id']); // Lấy id sản phẩm từ URL

  // Truy vấn thông tin sản phẩm
  $sql = "SELECT * FROM san_pham WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id_san_pham);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $san_pham = $result->fetch_assoc();
  } 
  else {
    $san_pham = null; // Không tìm thấy sản phẩm
  }
}
  else {
    echo "<p>Không có sản phẩm nào được chọn!</p>";
    exit;
  }

$sql = "SELECT * FROM san_pham";
$result = $conn->query($sql);

// Lưu dữ liệu vào mảng
$mang_san_pham = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $mang_san_pham[] = $row;
    }
}
  ?>

<?php
include "../kiem_tra_dang_nhap.php";
if ($isLoggedIn == NULL) {
  include_once "../header_footer/header/chua_login.php";
}
else {
  include_once "../header_footer/header/da_login.php";
}
?>

<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($san_pham ['ten_san_pham']);?></title>
  <link rel="stylesheet" href="chi_tiet_san_pham.css?v=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <script src="chi_tiet_san_pham.js" defer></script>
  <script src="them_vao_gio_hang/them_vao_gio_hang.js" defer></script>
  <script src="chon_mua/chon_mua.js" defer></script>
</head>

<body>

<section class="product-detail">
  <main class="main-content">
    <div class="product-container">
      <article class="product-info">
        <div class="product-main">
        <img src="../anh/<?php echo htmlspecialchars($san_pham['anh_minh_hoa']); ?>" alt="<?php echo htmlspecialchars($san_pham['ten_san_pham']); ?>" class="product-image">
          <div class="product-details">
            <h1 class="product-title"><?php echo htmlspecialchars($san_pham['ten_san_pham']); ?></h1>
            <!--number_format($number, $decimals, $decimal_separator, $thousand_separator)-->
            <p class="product-price"><?php echo number_format($san_pham['gia_ban'], 0, '.', ','); ?> ₫</p>
            
            <div class="quantity-selector" role="group" aria-label="Product quantity selector">
              <span class="quantity-label">Số lượng</span>
              <button class="quantity-btn" id="decrease-btn" aria-label="Decrease quantity">-</button>
              <input type="number" class="quantity-value" id="quantity-input" value="1" min="1" max="<?php echo $san_pham['so_luong_trong_kho']; ?>">
              <button class="quantity-btn" id="increase-btn" aria-label="Increase quantity">+</button>
            </div>
            
            <div class="product-actions">
              <button class="cart-btn" onclick="addToCart(<?php echo $san_pham['id']; ?>)">Thêm vào giỏ hàng</button>
              <button class="buy-btn" onclick="payment(<?php echo $san_pham['id']; ?>)">Mua ngay</button>
            </div>
            
            <div class="product-category">
              <span class="category-label">PHÂN LOẠI:</span>
              <span class="category-value"><?php echo htmlspecialchars($san_pham['phan_loai']); ?></span>
            </div>
          </div>
        </div>

        <section class="product-description">
          <h2 class="description-title">Mô tả sản phẩm</h2>
          <div class="description-content">
            <p class="description-text"><?php echo nl2br(htmlspecialchars($san_pham['mo_ta_san_pham'])); ?></p>
          </div>
        </section>
      </article>

      <aside class="categories-sidebar">
        <h2 class="categories-title">Danh mục sản phẩm</h2>
        <div class="categories-divider"></div>
        <nav>
          <ul role="list">
            <li class="category-item" onclick="location.href='../danh_sach_san_pham/danh_sach_san_pham.php?category=hoa%20tai'">Hoa tai</li>
            <li class="category-item" onclick="location.href='../danh_sach_san_pham/danh_sach_san_pham.php?category=nhan'">Nhẫn</li>
            <li class="category-item" onclick="location.href='../danh_sach_san_pham/danh_sach_san_pham.php?category=vong%20co'">Vòng cổ</li>
            <li class="category-item" onclick="location.href='../danh_sach_san_pham/danh_sach_san_pham.php?category=vong%20tay'">Vòng tay</li>
          </ul>
        </nav>
      </aside>
      
    </div>
  </main>

  <section class="bestseller-section">
  <h2 class="bestseller-header">BEST SELLER</h2>
  <div class="bestseller-divider"></div>
  
  <div class="bestseller-grid">
    <?php foreach ($bestsellers as $san_pham): 
      $san_pham_url = htmlspecialchars("../chi_tiet_san_pham/chi_tiet_san_pham.php?id=" . $san_pham['id_san_pham']); ?>
    <article class="product-card" onclick="window.location.href='<?= $san_pham_url; ?>'">
      <img src="../anh/<?php echo htmlspecialchars($san_pham['anh_minh_hoa']); ?>" alt="<?php echo htmlspecialchars($san_pham['ten_san_pham']); ?>" class="product-card-image">
      <h3 class="product-card-title"><?php echo htmlspecialchars(shortenText($san_pham['ten_san_pham'])); ?></h3>
      <p class="product-card-price" onclick="event.stopPropagation();"><?php echo number_format($san_pham['gia_ban'], 0, '.', ','); ?>₫</p>
      <button class="product-card-action" onclick="event.stopPropagation(); payment(<?php echo htmlspecialchars($san_pham['id_san_pham']) ?>);">
        <i class="fas fa-shopping-cart"></i>
        <span class="action-text">Chọn mua</span>
      </button>
    </article>
    <?php endforeach; ?>
  </div>
</section>
</section>
</body>

<?php 
include "../header_footer/footer/footer.php"
?>
</html>