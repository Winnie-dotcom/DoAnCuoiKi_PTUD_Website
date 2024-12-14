<?php
// Kết nối đến cơ sở dữ liệu
include('../db_connection.php');

// Lấy ID sản phẩm từ URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM san_pham WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $anh_minh_hoa = $product['anh_minh_hoa'];

    if (!$product) {
        die("Không tìm thấy sản phẩm.");
    }
} else {
    die("Không có ID sản phẩm.");
}
// Lấy danh sách tất cả danh mục
$query_danh_muc = "SELECT DISTINCT phan_loai FROM san_pham";
$result_danh_muc = $conn->query($query_danh_muc);
if (!$result_danh_muc) {
    die("Lỗi truy vấn danh mục: " . $conn->error);
}

?>
<title> Chỉnh sửa sản phẩm </title>

<link rel="stylesheet" href="style1.css">    
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

<div class="product-section">
  <div class="layout-container">
    <nav class="sidebar">
    <div class="nav-container">
      <div class="logo-container">
      <div class="brand-logo">
          <img src="logo.png" alt="Brand Logo" class="logo-image">
          </div>
</div>
          <a href="../backend_san_pham/backend_san_pham.php" class="nav-item active">
          <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/0f4878f968496374dde71db3b5d3b48e430aea5cbbbdc17b9a992c9073fb1cee?placeholderIfAbsent=true&apiKey=c0a07ac21f1245ca94f2e7b6c096677c" alt="" class="nav-icon" />
          <span>Sản phẩm</span>
        </a>

        <a href="../quan_ly_don/quan_ly_don.php" class="nav-item active">
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
      <h1 class="page-title">Chỉnh sửa sản phẩm</h1>
      <form class="form-container" action="cap_nhat_san_pham.php" method="POST" enctype="multipart/form-data">
        <!-- Truyền ID sản phẩm qua input hidden -->
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['id']); ?>" />

        <div class="form-section">
          <div class="form-group">
            <label for="product-name" class="form-label">Tên sản phẩm:</label>
            <input type="text" id="product-name" name="product_name" class="form-input" value="<?php echo htmlspecialchars($product['ten_san_pham']); ?>" required />
          </div>

          <div class="form-group">
            <label for="product-price" class="form-label">Giá:</label>
            <div>
              <input type="number" id="product-price" name="product_price" class="form-input-small" value="<?php echo htmlspecialchars($product['gia_ban']); ?>" required />
              <span>VND</span>
            </div>
          </div>

          <div class="form-group">
            <label for="product-stock" class="form-label">Số lượng trong kho:</label>
            <input type="number" id="product-stock" name="product_stock" class="form-input-small" value="<?php echo htmlspecialchars($product['so_luong_trong_kho']); ?>" required />
          </div>
        </div>

        <div class="side-section">
          <div class="upload-container">
            <div class="form-group">
              <label for="category" class="form-label">Danh mục:</label>
              <!-- Giữ nguyên nếu bạn có thêm danh mục -->
              <select id="category" name="category" class="form-input" required>
<?php
// Hiển thị danh mục từ kết quả truy vấn
while ($row = $result_danh_muc->fetch_assoc()) {
    if (!empty($row['phan_loai'])) { // Loại bỏ các giá trị trống hoặc không hợp lệ
        $selected = ($row['phan_loai'] == $product['phan_loai']) ? 'selected' : ''; // Nếu danh mục trùng với sản phẩm hiện tại
        echo "<option value='" . htmlspecialchars($row['phan_loai']) . "' $selected>" . htmlspecialchars($row['phan_loai']) . "</option>";
    }
}
?>
</select>


            </div>

            <div class="form-group">
              <div>
              <label for="product-image">Ảnh:</label>
              <input type="file" id="product-image" name="product_image" accept="image/*" style="display: none;">
              <button type="button" id="change-image-btn" class="custom-btn">Thay ảnh</button>
              <div id="preview-container">
                  <img id="current-preview" src="../anh/<?php echo htmlspecialchars($anh_minh_hoa); ?>" alt="Ảnh hiện tại" style="max-width: 200px;">
                  <img id="new-preview" style="display: none; max-width: 200px;" alt="Ảnh xem trước">
              </div>

                <script>
                  const changeImageBtn = document.getElementById('change-image-btn');
                  const productImageInput = document.getElementById('product-image');
                  const newPreview = document.getElementById('new-preview');
                  const currentPreview = document.getElementById('current-preview');

                  changeImageBtn.addEventListener('click', function () {
                      productImageInput.click(); // Mở cửa sổ chọn file khi nhấn nút
                  });

                  productImageInput.addEventListener('change', function () {
                      const file = this.files[0];
                      if (file) {
                          const reader = new FileReader();
                          reader.onload = function (e) {
                              // Hiển thị ảnh mới
                              newPreview.src = e.target.result;
                              newPreview.style.display = 'block';
                              // Ẩn ảnh hiện tại
                              currentPreview.style.display = 'none';
                          };
                          reader.readAsDataURL(file);
                      } else {
                          // Nếu không chọn file, hiển thị lại ảnh hiện tại
                          newPreview.style.display = 'none';
                          currentPreview.style.display = 'block';
                      }
                  });
               </script>

              </div>
            </div>
          </div>
        </div>

        <label for="product-description" class="form-label">Mô tả sản phẩm:</label>
        <textarea id="product-description" name="product_description" class="description-area" required><?php echo htmlspecialchars($product['mo_ta_san_pham']); ?></textarea>

        <button type="submit" class="submit-btn">Cập nhật</button>
      </form>
    </main>
  </div>
</div>