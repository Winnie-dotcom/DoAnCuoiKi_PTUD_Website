<?php
include "../db_connection.php"; // Kết nối cơ sở dữ liệu

// Lấy ID từ query string
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$blog = null;

if ($id) {
    // Truy vấn để lấy thông tin bài blog
    $stmt = $conn->prepare("SELECT * FROM blog WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $blog = $result->fetch_assoc();
    } else {
        echo "<p>Bài viết không tồn tại.</p>";
        exit;
    }
    $stmt->close();
} else {
    echo "<p>ID bài viết không hợp lệ.</p>";
    exit;
}

// Đóng kết nối
$conn->close();
?>


<title> Chỉnh sửa Blogs</title>
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
      <h1 class="page-title">Sửa Blog</h1>

      <form class="form-container" action="cap_nhat_blog.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $blog['id'] ?>" /> <!-- Ẩn ID -->

    <div class="form-section">
        <div class="form-group">
            <label for="ten_blog" class="form-label">Tiêu đề:</label>
            <input type="text" id="ten_blog" name="ten_blog" class="form-input" required value="<?= htmlspecialchars($blog['ten_blog']) ?>">
        </div>

        <div class="form-group">
            <label for="tac_gia" class="form-label">Tác giả:</label>
            <input type="text" id="tac_gia" name="tac_gia" class="form-input-small" required value="<?= htmlspecialchars($blog['tac_gia']) ?>">
        </div>
    </div>

    <div class="side-section">
        <div class="upload-container">
            <div class="form-group">
                <label for="ngay_dang" class="form-label">Ngày đăng:</label>
                <input type="date" id="ngay_dang" name="ngay_dang" class="form-input-small" required value="<?= htmlspecialchars($blog['ngay_dang']) ?>">
            </div>

            <div class="form-group">
                <label class="form-label">Ảnh:</label>
                <input type="file" id="product-image" name="product_image" class="form-input-file" accept="image/*" style="display: none;">
                <button type="button" class="upload-btn" onclick="document.getElementById('product-image').click()">Sửa ảnh</button>
                <div id="preview-container">
                    <?php if (!empty($blog['image_path'])): ?>
                        <img src="<?= $blog['image_path'] ?>" alt="Preview" style="width: 150px; height: auto; margin-top: 10px;">
                    <?php endif; ?>
                </div>
                <script>
                document.getElementById("product-image").addEventListener("change", function () {
                const fileInput = this;
                const previewContainer = document.getElementById("preview-container");

                // Nếu có file được chọn
                if (fileInput.files && fileInput.files[0]) {
                    const reader = new FileReader();

                    // Tạo ảnh xem trước
                    reader.onload = function (e) {
                        let imgPreview = previewContainer.querySelector("img");
                        if (!imgPreview) {
                            imgPreview = document.createElement("img");
                            imgPreview.style.width = "150px";
                            imgPreview.style.height = "auto";
                            imgPreview.style.marginTop = "10px";
                            previewContainer.appendChild(imgPreview);
                        }
                        imgPreview.src = e.target.result;
                    };
                    reader.readAsDataURL(fileInput.files[0]);
                }
            });
            </script>
            </div>
        </div>
    </div>

    <label for="noi_dung" class="form-label">Nội dung bài viết:</label>
    <textarea id="noi_dung" name="noi_dung" class="description-area" required><?= htmlspecialchars($blog['noi_dung']) ?></textarea>

    <button type="submit" class="submit-btn">Cập nhật</button>
</form>

    </main>
  </div>
</div>

<script>
  function showSuccessAlert() {
    alert("Bài viết đã được sửa thành công!");
  }
</script>