<?php
include "../db_connection.php";

// Kiểm tra form được gửi bằng POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Lấy dữ liệu từ form
    $ten_san_pham = $_POST['product_name'] ?? '';
    $gia_ban = $_POST['product_price'] ?? 0;
    $so_luong_trong_kho = $_POST['product_stock'] ?? 0;
    $phan_loai = $_POST['category'] ?? ''; 
    $anh_minh_hoa = $_FILES['product_image']['name']; //Chỉ lấy tên hình ảnh để up lên db
    $anh_minh_hoa_tmp_name = $_FILES['product_image']['tmp_name']; //Lấy đường dẫn của ảnh
    $mo_ta_san_pham = $_POST['product_description'] ?? '';

    move_uploaded_file($anh_minh_hoa_tmp_name , '../anh/' . $anh_minh_hoa);


    // Thêm sản phẩm vào cơ sở dữ liệu
    $sql = "INSERT INTO san_pham (ten_san_pham, gia_ban, so_luong_trong_kho, phan_loai, anh_minh_hoa, mo_ta_san_pham)
            VALUES (?, ?, ?, ?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sdisss", $ten_san_pham, $gia_ban, $so_luong_trong_kho, $phan_loai, $anh_minh_hoa, $mo_ta_san_pham);

        // Kiểm tra xem câu lệnh có thực thi được không
        if ($stmt->execute()) {
            echo "<script>alert('Thêm sản phẩm thành công!');</script>";
            header("Location: them_san_pham.php");  // Sau khi thành công, chuyển hướng
            exit();
        } else {
            echo "<script>alert('Lỗi khi thêm sản phẩm: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Lỗi câu lệnh SQL!');</script>";
    }
}

$conn->close();
?>
<title> Thêm sản phẩm </title>
<link rel="stylesheet" href="style.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

<div class="product-management">
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
    <h1 class="page-title">Thêm sản phẩm</h1>
    <?php if (!empty($message)): ?>
                    <p style="color: green;"><?php echo $message; ?></p>
                <?php endif; ?>
      <form class="form-container" action="them_san_pham.php" method="POST" enctype="multipart/form-data">
        <div class="form-section">
          
          <div class="form-group">
            <label for="product-name" class="form-label">Tên sản phẩm:</label>
            <input type="text" id="product-name" name="product_name" class="form-input" required />
          </div>

          <div class="form-group">
            <label for="product-price" class="form-label">Giá:</label>
            <div>
            <input type="number" id="product-price" name="product_price" class="form-input-small" required />
              <span>VND</span>
            </div>
          </div>

          <div class="form-group">
            <label for="product-stock" class="form-label">Số lượng trong kho:</label>
            <input type="number" id="product-stock" name="product_stock" class="form-input-small" required />
          </div>
        </div>

        <div class="side-section">
          <div class="upload-container">
            <div class="form-group">
              <label for="category" class="form-label">Danh mục:</label>
              <select id="category" name="category" class="form-input" required>
              <option value="Nhẫn">Nhẫn</option>
              <option value="Vòng tay">Vòng tay</option>
              <option value="Vòng cổ">Vòng cổ</option>
              <option value="Hoa tai">Hoa tai</option>
              </select> 
              
            </div>

            <div class="form-group">
   
    <div>
    <label class="form-label">Ảnh:</label>
        <input type="file" id="product-image" name="product_image" class="form-input-file" accept="image/*" style="display: none;" />
        <button type="button" class="upload-btn" onclick="document.getElementById('product-image').click()">Thêm ảnh</button>
        <div id="preview-container">
            <!-- Xem trước ảnh sẽ hiển thị ở đây -->
        </div>
    </div>
</div>

          </div>
        </div>

        <label for="product-description" class="form-label">Mô tả sản phẩm</label>
        <textarea id="product-description" name="product_description" class="description-area" required></textarea>

        <button type="submit" class="submit-btn" onclick="return validateForm()">Hoàn tất</button>

      </form>
    </main>
  </div>
</div>
<script>
  function validateForm() {
    const productName = document.getElementById('product-name').value.trim();
    const productPrice = document.getElementById('product-price').value.trim();
    const productStock = document.getElementById('product-stock').value.trim();
    const category = document.getElementById('category').value.trim();
    const productDescription = document.getElementById('product-description').value.trim();

    // Kiểm tra các trường có được điền đầy đủ không
    if (!productName || !productPrice || !productStock || !category || !productDescription) {
        alert("Vui lòng nhập đầy đủ thông tin!");
        return false; // Ngăn gửi form
    }

    // Nếu mọi trường đều hợp lệ
    alert("Thêm sản phẩm thành công.");
    return true;
}
 
// Xem trước ảnh đã chọn
    const productImageInput = document.getElementById('product-image');
    const previewContainer = document.getElementById('preview-container');

    productImageInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewContainer.innerHTML = `<img src="${e.target.result}" alt="Preview" style="width: 150px; height: auto; margin-top: 10px;" />`;
            };
            reader.readAsDataURL(file);
        }
    });
</script>

