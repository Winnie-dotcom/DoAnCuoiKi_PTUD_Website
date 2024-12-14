<?php
// Kết nối cơ sở dữ liệu
include "../db_connection.php";

// Lấy giá trị tìm kiếm và lọc từ form
$search_query = isset($_GET['search']) ? trim($_GET['search']) : '';
$category_filter = isset($_GET['category']) ? $_GET['category'] : 'all';

// Khởi tạo câu truy vấn cơ bản
$sql = "SELECT id,ten_san_pham, gia_ban, so_luong_trong_kho, phan_loai, anh_minh_hoa FROM san_pham WHERE 1";

// Thêm điều kiện tìm kiếm theo tên sản phẩm nếu có
if (!empty($search_query)) {
    $sql .= " AND ten_san_pham LIKE ?";
}

// Thêm điều kiện lọc theo danh mục nếu có
if ($category_filter !== 'all') {
    $sql .= " AND phan_loai = ?";
}

// Chuẩn bị truy vấn
$stmt = $conn->prepare($sql);

// Gán tham số vào câu truy vấn
if (!empty($search_query) && $category_filter !== 'all') {
    $search_param = '%' . $search_query . '%';
    $stmt->bind_param("ss", $search_param, $category_filter);
} elseif (!empty($search_query)) {
    $search_param = '%' . $search_query . '%';
    $stmt->bind_param("s", $search_param);
} elseif ($category_filter !== 'all') {
    $stmt->bind_param("s", $category_filter);
}

// Thực thi truy vấn
$stmt->execute();
$result = $stmt->get_result();
?>

<head>
<title> Quản lý sản phẩm </title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <meta charset="UTF8">
</head>
    <div class="product-management">
      <div class="layout-container">
    <nav class="sidebar">
    <div class="sidebar-content">
        <div class="brand-logo">        
          <img src="logo.png" alt="LOGO">
        </div>
        <div class="nav-content">
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
      </div>
    </nav>
        <!-- Main content -->
        <main class="main-content">
                <div class="header-container">
                    <h1 class="page-title">Quản lý sản phẩm</h1>
                    
                    <form class="search-container" role="search" method="get" action="">
                    <div class="search-form">
                        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/e7d1e978b0cf9046d93201057d022743e85881919990416da6dca5c2f6f756b2?placeholderIfAbsent=true&apiKey=c0a07ac21f1245ca94f2e7b6c096677c" alt="Search icon" class="nav-icon">
                        <input type="search" name="search" id="search-input" class="search-input" placeholder="Tìm kiếm sản phẩm" aria-label="Search products" value="<?php echo htmlspecialchars($search_query); ?>" onkeyup="showSuggestions(this.value)">
                        <div id="suggestion-box" class="suggestion-box"></div>
                        <button type="submit" class="search-button">Tìm kiếm</button>
                    </div>
                        <div class="filter-container">
                            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/95fdcc8eb54f3cebbaa8f171ecfef381de5e89194c456dd7ac7c6fbc11dc174d?placeholderIfAbsent=true&apiKey=c0a07ac21f1245ca94f2e7b6c096677c" 
                                 class="filter-icon" 
                                 alt="Filter options" 
                                 onclick="toggleFilterMenu()" />
                            <div id="filter-menu" class="filter-menu">
                                <label for="category-filter">Lọc theo danh mục:</label>
                                <select id="category-filter" name="category" class="category-filter" onchange="this.form.submit()">
                                <option value="all" <?php echo $category_filter === 'all' ? 'selected' : ''; ?>>Tất cả</option>
                            <option value="Hoa tai" <?php echo $category_filter === 'Hoa tai' ? 'selected' : ''; ?>>Hoa tai</option>
                            <option value="Vòng tay" <?php echo $category_filter === 'Vòng tay' ? 'selected' : ''; ?>>Vòng tay</option>
                            <option value="Nhẫn" <?php echo $category_filter === 'Nhẫn' ? 'selected' : ''; ?>>Nhẫn</option>
                            <option value="Vòng cổ" <?php echo $category_filter === 'Vòng cổ' ? 'selected' : ''; ?>>Vòng cổ</option>
                                </select>
                            </div>
                        </div>
                        <button type="button" class="add-product-btn" onclick="window.location.href= '../them_san_pham/them_san_pham.php'">Thêm sản phẩm</button>

                    </form>
                </div>

                <table class="product-table">
                    <thead>
                        <tr>
                            <th class="table-header">Mã sản phẩm</th>
                            <th class="table-header">Ảnh</th>
                            <th class="table-header">Tên</th>
                            <th class="table-header">Giá bán</th>
                            <th class="table-header">Tồn kho</th>
                            <th class="table-header">Danh mục</th>
                            <th class="table-header"> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr class='product-row'>";
                                echo "<td class='product-cell'>#" . $row['id'] . "</td>";
                                echo "<td class='product-cell'><img src='../anh/" . $row['anh_minh_hoa'] . "' alt='Ảnh sản phẩm' class='product-image'></td>";
                                echo "<td class='product-cell'>" . $row['ten_san_pham'] . "</td>";
                                echo "<td class='product-cell'>" . number_format($row['gia_ban'], 0, ',', '.') . "₫</td>";
                                echo "<td class='product-cell'>" . $row['so_luong_trong_kho'] . "</td>";
                                echo "<td class='product-cell' data-category='" . $row['phan_loai'] . "'>" . $row['phan_loai'] . "</td>";
                                echo "<td class='product-cell'>
                                <button class='action-button' aria-label='Edit' onclick=\"window.location.href='sua_san_pham.php?id=" . $row['id'] . "'\">
                                    <img src='https://cdn.builder.io/api/v1/image/assets/TEMP/ca999df985736f586fac2b2e4987433f1fa96f07ae33b872c7cc0a8fc788f34d' alt='Edit' class='action-icon' />
                                </button>
                                
                                <button class='action-button' aria-label='Delete' onclick='confirmDelete(" . $row['id'] . ")'>
                                    <img src='https://cdn.builder.io/api/v1/image/assets/TEMP/5161f1b2687398c0022ed4fa1935eb4f484e79abf11b4ae7601cf8a43c20e96d' alt='Delete' class='action-icon' />
                                </button>
                            </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>Không có sản phẩm nào</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </main>
        </div>
    </div>
    
    <script>
    function toggleFilterMenu() {
        const filterMenu = document.getElementById('filter-menu');
        filterMenu.style.display = filterMenu.style.display === 'none' || !filterMenu.style.display ? 'block' : 'none';
    }

    function applyFilter() {
        const filterValue = document.getElementById('category-filter').value.toLowerCase();
        const rows = document.querySelectorAll('.product-row');

        rows.forEach((row) => {
            const categoryCell = row.querySelector('[data-category]');
            const category = categoryCell.getAttribute('data-category').toLowerCase();

            if (filterValue === 'all' || category === filterValue) {
                row.style.display = ''; // Hiển thị hàng
            } else {
                row.style.display = 'none'; // Ẩn hàng
            }
        });

        // Ẩn menu sau khi áp dụng bộ lọc
        document.getElementById('filter-menu').style.display = 'none';
    }

    function showSuggestions(query) {
    const suggestionBox = document.getElementById('suggestion-box');
    if (query.length === 0) {
        suggestionBox.innerHTML = '';
        suggestionBox.classList.remove('show');
        return;
    }
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `backend_search_suggestion.php?query=${encodeURIComponent(query)}`, true);
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
    if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này?")) {
        const formData = new FormData();
        formData.append('id', productId);

        fetch('xoa_san_pham.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                location.reload(); // Tải lại trang sau khi xóa
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Đã xảy ra lỗi khi xóa sản phẩm.');
        });
    }
}


</script>
</body>
</html>