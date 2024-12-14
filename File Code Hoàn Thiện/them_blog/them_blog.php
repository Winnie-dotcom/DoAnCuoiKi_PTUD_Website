<?php
include "../db_connection.php";
error_log(print_r($_POST, true)); // Ghi lại dữ liệu POST nhận được

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Lấy dữ liệu từ form
        $ten_blog = isset($_POST['ten_blog']) ? trim($_POST['ten_blog']) : '';
        $ngay_dang = isset($_POST['ngay_dang']) ? trim($_POST['ngay_dang']) : '';
        $tac_gia = isset($_POST['tac_gia']) ? trim($_POST['tac_gia']) : '';
        $anh = $_FILES['product_image']['name']; //Chỉ lấy tên hình ảnh để up lên db
        $anh_tmp_name = $_FILES['product_image']['tmp_name']; //Lấy đường dẫn của ảnh
        $noi_dung = isset($_POST['noi_dung']) ? trim($_POST['noi_dung']) : '';

        move_uploaded_file($anh_tmp_name , '../anh/' . $anh);


        // Kiểm tra dữ liệu đầu vào
        if (empty($ten_blog) || empty($ngay_dang) || empty($tac_gia) || empty($noi_dung)) {
            echo json_encode(['success' => false, 'message' => 'Vui lòng điền đầy đủ thông tin.']);
            exit;
        }

        // Chuẩn bị truy vấn thêm blog
        $stmt = $conn->prepare("INSERT INTO blog (ten_blog, ngay_dang, tac_gia, noi_dung, anh) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $ten_blog, $ngay_dang, $tac_gia, $noi_dung, $anh);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Bài viết đã được thêm thành công.']);
            exit; // Ngừng tất cả việc xuất dữ liệu sau khi gửi JSON
            
        } else {
            error_log("Lỗi MySQL: " . $stmt->error); // Ghi log lỗi MySQL
            echo json_encode(['success' => false, 'message' => 'Lỗi khi thêm bài viết.']);
        }

        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        error_log("Lỗi PHP: " . $e->getMessage()); // Ghi log lỗi PHP
        echo json_encode(['success' => false, 'message' => 'Đã xảy ra lỗi trên server.']);
    }
}



?>

<title> Thêm Blogs</title>
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
    <h1 class="page-title">Thêm Blogs</h1>
    
      <form class="form-container" action="them_blog.php" method="POST" enctype="multipart/form-data">
        <div class="form-section">
          
          <div class="form-group">
          <label for="ten_blog"class="form-label">Tiêu đề:</label>
          <input type="text" id="ten_blog" name="ten_blog" class="form-input"required>
          </div>

          

          <div class="form-group">
          <label for="tac_gia"class="form-label">Tác giả:</label>
          <input type="text" id="tac_gia" name="tac_gia" class="form-input-small"required>

          </div>
        </div>

        <div class="side-section">
          <div class="upload-container">
            <div class="form-group">
            <label for="ngay_dang"class="form-label">Ngày đăng:</label>
            <input type="date" id="ngay_dang" name="ngay_dang" class="form-input-small" required>
              
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

        <label for="noi_dung" class="form-label">Nội dung bài viết:</label>
        <textarea id="noi_dung" name="noi_dung" class="description-area" required></textarea>

        <button type="submit" class="submit-btn" onclick="return validateForm()">Hoàn tất</button>


      </form>
    </main>
  </div>
</div>
<script>
 // Hàm kiểm tra dữ liệu form
function validateForm() {
    const tenBlog = document.getElementById('ten_blog').value.trim();
    const ngayDang = document.getElementById('ngay_dang').value.trim();
    const tacGia = document.getElementById('tac_gia').value.trim();
    const noiDung = document.getElementById('noi_dung').value.trim();

    // Kiểm tra nếu có trường nào thiếu thông tin
    if (!tenBlog || !ngayDang || !tacGia || !noiDung) {
        alert("Vui lòng điền đầy đủ thông tin!");
        return false; // Ngừng gửi form
    }

    return true; // Cho phép gửi form nếu tất cả trường hợp lệ
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

document.querySelector('form').addEventListener('submit', async (event) => {
    event.preventDefault(); // Ngừng gửi form mặc định

    // Kiểm tra tính hợp lệ của form trước khi gửi
    if (!validateForm()) {
        return; // Nếu validate không hợp lệ, dừng lại
    }

    const formData = new FormData(event.target);

    try {
        const response = await fetch('them_blog.php', {
            method: 'POST',
            body: formData,
        });

        const textResponse = await response.text(); // Lấy phản hồi thô để debug
        console.log(textResponse); // Log phản hồi để kiểm tra
        const result = JSON.parse(textResponse); // Parse JSON từ phản hồi

        if (!response.ok) {
            console.error('Lỗi HTTP:', response.status, response.statusText);
            alert('Đã xảy ra lỗi khi gửi dữ liệu.');
            return;
        }

        if (result.success) {
            alert("Thêm bài viết thành công!"); // Hiển thị thông báo thành công
            event.target.reset();  // Reset form sau khi thành công
        } else {
            alert(result.message); // Hiển thị thông báo lỗi từ server
        }
    } catch (error) {
        console.error('Lỗi parse hoặc mạng:', error);
        alert('Đã xảy ra lỗi khi gửi dữ liệu.');
    }
});
</script>

