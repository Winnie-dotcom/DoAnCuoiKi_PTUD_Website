<?php
// Kết nối cơ sở dữ liệu
include '../db_connection.php';

// Lấy ID hoặc thông tin blog cần hiển thị
if (isset($_GET['id'])) {
    $blog_id = intval($_GET['id']); // Lấy id từ URL

// Truy vấn dữ liệu bài viết
$sql = "SELECT * FROM blog WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $blog_id);
$stmt->execute();
$result = $stmt->get_result();

// Lấy bài viết nếu có
if ($result->num_rows > 0) {
    $blog = $result->fetch_assoc();
  } 
  else {
    $blog = null; // Không tìm thấy bài viết
  }
}
  else {
    echo "<p>Không có blog nào được chọn!</p>"; 
    exit; // Dừng chương trình nếu không có id hợp lệ
}

// Kiểm tra nếu không có blog
if (!$blog) {
echo "<p>Không tìm thấy blog!</p>";
exit;
}

// Truy vấn dữ liệu bài blog
$sql = "SELECT * FROM blog";
$result = $conn->query($sql);

// Lưu dữ liệu vào mảng
$blogs = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $blogs[] = $row;
    }
}
?>
  <?php  
    // Tạo truy vấn SQL cho bài viết ngẫu nhiên (featured-posts)
    $sqlFeatured = "SELECT * FROM blog ORDER BY RAND()";  // Lấy bài viết ngẫu nhiên
    $resultFeatured = $conn->query($sqlFeatured);

    
    // Tạo truy vấn SQL cho bài viết mới nhất (recent-posts)
    $sqlRecent = "SELECT * FROM blog ORDER BY ngay_dang DESC";
    $resultRecent = $conn->query($sqlRecent);
    
    
    $recentBlogs = [];
    if ($resultRecent->num_rows > 0) {
        while ($row = $resultRecent->fetch_assoc()) {
            $recentBlogs[] = $row;
        }
    }

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="chi_tiet_blog.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <title><?php echo htmlspecialchars($blog['ten_blog']); ?></title>
</head>
<body>

<?php
include "../kiem_tra_dang_nhap.php";
if ($isLoggedIn == NULL) {
  include_once "../header_footer/header/chua_login.php";
}
else {
  include_once "../header_footer/header/da_login.php";
}
?>

    <div class="blog-detail">
        <div class="content">
            <div class="content-columns">
                <!-- Nội dung bài viết -->
                <div class="main-content">
                    <article class="article-content">
                        <h1 class="article-title"><?php echo htmlspecialchars($blog['ten_blog']); ?></h1>
                        
                        <figure class="image-container">
                            <img src="../anh/<?php echo  htmlspecialchars($blog['anh']); ?>" alt="<?php echo htmlspecialchars($blog['ten_blog']); ?>" class="article-image" style="width: 100%; border-radius: 10px;">
                            <figcaption class="image-caption">
                                Đăng bởi: <?php echo htmlspecialchars($blog['tac_gia']); ?> - Ngày: <?php echo htmlspecialchars($blog['ngay_dang']); ?>
                            </figcaption>
                        </figure>

                        <p class="article-text"><?php echo nl2br(htmlspecialchars($blog['noi_dung'])); ?></p>
                    </article>
                </div>

                <!-- Sidebar -->
                <aside class="sidebar">
                <div class="banner-fade">
                <img src="https://i.pinimg.com/736x/72/f5/0b/72f50b3895d6f17f05eec83b196dfc71.jpg" alt="Advertisement 1" class="banner-img active">
                <img src="https://i.pinimg.com/736x/74/0f/d0/740fd05a1fb4cf4b0a5c558b68d8207b.jpg" alt="Advertisement 2" class="banner-img">
                <img src="https://i.pinimg.com/736x/0b/df/85/0bdf851d6001705ca1c5943931a6846a.jpg" alt="Advertisement 3" class="banner-img">
                <img src="https://i.pinimg.com/736x/7d/7b/d2/7d7bd2842b2cd61f2e9ddc5c6ebae8fb.jpg" alt="Advertisement 4" class="banner-img">
                <img src="https://i.pinimg.com/736x/44/5f/39/445f398c6073fadf0781ed92d48ffa48.jpg" alt="Advertisement 5" class="banner-img">

                </div>


                        <!-- Bài viết nổi bật -->
                        <div class="featured-posts">
                            <h2 class="recent-posts-title">Bài viết nổi bật</h2>
                            <?php
                            // Truy vấn bài viết nổi bật
                            $sql_featured = "SELECT * FROM blog ORDER BY RAND() LIMIT 2";
                            $featured_posts = $conn->query($sql_featured);

                            while ($post = $featured_posts->fetch_assoc()) {
                                // Tạo URL cho bài viết chi tiết
                                $Url = "../chi_tiet_blog/chi_tiet_blog.php?id=" . $post['id'];
                                echo '<article class="post-card" onclick=\'location.href="' . $Url . '";\'>';
                                echo '<img src="../anh/' . htmlspecialchars($post['anh']) . '" alt="' . htmlspecialchars($post['ten_blog']) . '" style="width: 100%; border-radius: 10px;">';
                                echo '<h2 class="post-title">' . htmlspecialchars($post['ten_blog']) . '</h2>';
                                echo '<time class="post-date">' . htmlspecialchars($post['ngay_dang']) . '</time>';
                                echo '</article>';
                            }
                            ?>
                        </div>

                        <!-- Bài viết mới nhất -->
                        <div class="recent-posts">
                        <h2 class="recent-posts-title">Bài viết mới nhất</h2>
                        <div class="recent-posts-list">
                        <?php
                            foreach ($recentBlogs as $blog) {
                            $lUrl = "../chi_tiet_blog/chi_tiet_blog.php?id=" . $blog['id'];
                                echo "<p class='recent-post-title' onclick=\"location.href='$lUrl';\">" . htmlspecialchars($blog['ten_blog']) . "</p>";
                                echo "<div class='divider-line'></div>";
                            }
                        ?>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>

<?php 
include "../header_footer/footer/footer.php"
?>
</body>
</html>
<script>
  const images = document.querySelectorAll(".banner-img");
let currentIndex = 0;

function changeImage() {
    // Ẩn ảnh hiện tại
    images[currentIndex].classList.remove("active");
    
    // Chuyển sang ảnh tiếp theo
    currentIndex = (currentIndex + 1) % images.length;
    
    // Hiển thị ảnh mới
    images[currentIndex].classList.add("active");
}

// Thay đổi ảnh mỗi 3 giây
setInterval(changeImage, 3000);
</script>