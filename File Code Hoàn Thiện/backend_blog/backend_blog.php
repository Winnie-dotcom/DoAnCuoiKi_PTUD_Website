<?php
// Kết nối cơ sở dữ liệu
include "../db_connection.php";

// Lấy giá trị tìm kiếm và lọc từ form
$search_query = isset($_GET['search']) ? trim($_GET['search']) : '';

// Khởi tạo câu truy vấn cơ bản
$sql = "SELECT id,ten_blog, ngay_dang, tac_gia FROM blog WHERE 1";

// Thêm điều kiện tìm kiếm theo tên bài viết nếu có
if (!empty($search_query)) {
    $sql .= " AND ten_blog LIKE ?";
}

// Chuẩn bị truy vấn
$stmt = $conn->prepare($sql);

// Gắn tham số cho truy vấn nếu có tìm kiếm
if (!empty($search_query)) {
    $param = "%" . $search_query . "%";
    $stmt->bind_param("s", $param);
}

// Thực thi truy vấn
$stmt->execute();
$result = $stmt->get_result();

?>


<!DOCTYPE html>
<title> Quản lý Blogs</title>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
<head> <meta charset="UTF8">
<link rel="stylesheet" href="style.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

</head>
<body>
<div class="product-management">
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
        <!-- Main content -->
        <main class="main-content">
                
                    <h1 class="page-title">Quản lý Blogs</h1>
                    <div class="header-container">
                    <form class="search-container" role="search" method="get" action="">
                    <div class="search-form">
                    <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/e7d1e978b0cf9046d93201057d022743e85881919990416da6dca5c2f6f756b2?placeholderIfAbsent=true&apiKey=c0a07ac21f1245ca94f2e7b6c096677c" alt="Search icon" class="nav-icon">

                        <input type="search" name="search" id="search-input" class="search-input" placeholder="Tìm kiếm bài viết" aria-label="Search products" value="<?php echo htmlspecialchars($search_query); ?>" onkeyup="showSuggestions(this.value)">
                        <div id="suggestion-box" class="suggestion-box"></div>
                        <button type="submit" class="search-button">Tìm kiếm</button>
                    </div>
                        
                        <button type="button" class="add-product-btn" onclick="window.location.href= '../them_blog/them_blog.php'">Thêm bài viết</button>

                    </form>
                </div>
                <div class="product-container">
                <table class="product-table">
                    <thead>
                        <tr>
                            <th class="table-header">Mã số</th>
                            <th class="table-header">Tiêu đề</th>
                            <th class="table-header">Ngày đăng</th>
                            <th class="table-header">Tác giả</th>
                            <th class="table-header"> </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr class='product-row'>";
                    echo "<td class='product-cell'>#" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td class='product-cell'>" . htmlspecialchars($row['ten_blog']) . "</td>";
                    echo "<td class='product-cell'>" . htmlspecialchars($row['ngay_dang']) . "</td>";
                    echo "<td class='product-cell'>" . htmlspecialchars($row['tac_gia']) . "</td>";
                    echo "<td class='product-cell'>
                        <button class='action-button' aria-label='Edit' onclick=\"window.location.href='sua_blog.php?id=" . $row['id'] . "'\">
                                    <img src='https://cdn.builder.io/api/v1/image/assets/TEMP/ca999df985736f586fac2b2e4987433f1fa96f07ae33b872c7cc0a8fc788f34d' alt='Edit' class='action-icon' />
                                </button>
                         <button class='action-button' aria-label='Delete' onclick='confirmDelete(" . $row['id'] . ")'>
                                    <img src='https://cdn.builder.io/api/v1/image/assets/TEMP/5161f1b2687398c0022ed4fa1935eb4f484e79abf11b4ae7601cf8a43c20e96d' alt='Delete' class='action-icon' />
                                </button>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Không có bài viết nào</td></tr>";
            }
            ?>
                    </tbody>
                </table>
            </main>
        </div>
    </div>
    
    <script>
    
    function showSuggestions(query) {
    const suggestionBox = document.getElementById('suggestion-box');
    if (query.length === 0) {
        suggestionBox.innerHTML = '';
        suggestionBox.classList.remove('show');
        return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open('GET', `search_blog_suggestion.php?query=${encodeURIComponent(query)}`, true);
    xhr.onload = function () {
        if (this.status === 200) {
            const suggestions = JSON.parse(this.responseText);
            let suggestionHTML = '';
            suggestions.forEach(function (suggestion) {
                suggestionHTML += `<div class="suggestion-item" onclick="selectSuggestion('${suggestion}')">${suggestion}</div>`;
            });
            suggestionBox.innerHTML = suggestionHTML;
            suggestionBox.classList.add('show'); // Hiển thị hộp gợi ý
        }
    };
    xhr.send();
}

function selectSuggestion(value) {
    document.getElementById('search-input').value = value;
    document.getElementById('suggestion-box').classList.remove('show'); // Ẩn hộp gợi ý sau khi chọn
}


function confirmDelete(productId) {
    // Hiển thị hộp thoại xác nhận với người dùng
    if (confirm("Bạn có chắc chắn muốn xóa bài viết này?")) {
        // Tạo một đối tượng FormData để gửi dữ liệu
        const formData = new FormData();
        formData.append('id', productId);

        // Gửi yêu cầu xóa bài viết đến máy chủ
        fetch('xoa_blog.php', {
            method: 'POST', // Sử dụng phương thức POST để bảo mật
            body: formData, // Đính kèm dữ liệu bài viết cần xóa
        })
        .then(response => {
            // Kiểm tra nếu phản hồi không thành công (HTTP status >= 400)
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json(); // Chuyển đổi phản hồi sang JSON
        })
        .then(data => {
            // Kiểm tra trạng thái trả về từ máy chủ
            if (data.success) {
                alert(data.message); // Hiển thị thông báo thành công
                location.reload(); // Tải lại trang để cập nhật danh sách
            } else {
                alert(data.message); // Hiển thị thông báo lỗi từ máy chủ
            }
        })
        .catch(error => {
            // Bắt và xử lý lỗi liên quan đến fetch hoặc máy chủ
            console.error('Error:', error);
            alert('Đã xảy ra lỗi khi xóa bài viết. Vui lòng thử lại sau.');
        });
    }
}

</script>
</body>
</html>