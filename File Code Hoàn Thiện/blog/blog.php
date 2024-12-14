<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="blog.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
<title>Blog</title>
</head>

<?php
// Kết nối cơ sở dữ liệu
include "../db_connection.php";

// Nhận từ khóa tìm kiếm
$searchKeyword = isset($_GET['q']) ? trim($_GET['q']) : '';

// Tạo truy vấn SQL cho bài viết ngẫu nhiên (featured-posts)
if ($searchKeyword) {
    $sqlFeatured = "SELECT * FROM blog WHERE (ten_blog LIKE ? OR noi_dung LIKE ?) ORDER BY RAND()";
    $stmtFeatured = $conn->prepare($sqlFeatured);
    $likeKeyword = '%' . $searchKeyword . '%';
    $stmtFeatured->bind_param("ss", $likeKeyword, $likeKeyword);
    $stmtFeatured->execute();
    $resultFeatured = $stmtFeatured->get_result();
} else {
    $sqlFeatured = "SELECT * FROM blog ORDER BY RAND()";  // Lấy bài viết ngẫu nhiên
    $resultFeatured = $conn->query($sqlFeatured);
}

// Tạo truy vấn SQL cho bài viết mới nhất (recent-posts)
$sqlRecent = "SELECT * FROM blog ORDER BY ngay_dang DESC";
$resultRecent = $conn->query($sqlRecent);

// Lưu dữ liệu vào mảng cho bài viết
$featuredBlogs = [];
if ($resultFeatured->num_rows > 0) {
    while ($row = $resultFeatured->fetch_assoc()) {
        $featuredBlogs[] = $row;
    }
}

$recentBlogs = [];
if ($resultRecent->num_rows > 0) {
    while ($row = $resultRecent->fetch_assoc()) {
        $recentBlogs[] = $row;
    }
}
?>

<html>
  <body>

<?php
include "../kiem_tra_dang_nhap.php";
if ($isLoggedIn == NULL) {
  include_once "../header_footer/header/chua_login.php";
} else {
  include_once "../header_footer/header/da_login.php";
}
?>

<div class="blog-container">
  <div class="content">
    <form class="search-bar" role="search" method="get" id="searchForm">
    <div class="search-input-wrapper">
        <label for="searchInput" class="visually-hidden"></label>
        <input type="search" id="searchInput" name="q" class="search-text" placeholder="Tìm kiếm bài viết" />
    </div>
    <button type="submit" class="search-button">Tìm kiếm</button>
    </form>

    <h1 class="page-title">Tin tức về trang sức</h1>

    <div class="carousel">
      <img src="https://t3.ftcdn.net/jpg/03/68/92/66/360_F_368926684_Y4Fr8MQpDmNZsZPyu5ehbBc35rLcalHy.jpg" alt="Feature 1" class="carousel-image active">
      <img src="https://t4.ftcdn.net/jpg/02/92/56/91/360_F_292569117_IXB16oP1A5U47bTVRnY0FOXZfXKYesjn.jpg" alt="Feature 2" class="carousel-image">
      <img src="https://t4.ftcdn.net/jpg/02/92/56/91/360_F_292569116_Phht4uRj1YIuLFgBhrLu8171npBOcJcr.jpg" alt="Feature 3" class="carousel-image">
    </div>

    <div class="content-grid">
      <div class="grid-container">
        <div class="main-content">
          <div class="featured-posts">
            <h2 class="section-title">Bài viết nổi bật</h2>
            <?php if (empty($featuredBlogs)): ?>
                <div class="no-results">
                  <p>Không tìm thấy bài viết</p>
                </div>
              <?php else: ?>
            <?php
            $isFirstDiv = true;
            $isPostGridOpen = false;

            foreach ($featuredBlogs as $blog) {
              // Tạo URL cho bài viết chi tiết
              $detailUrl = "../chi_tiet_blog/chi_tiet_blog.php?id=" . $blog['id'];

              if ($isFirstDiv) {
                  echo "<div class='most-featured-post' onclick=\"location.href='$detailUrl';\">";
                  echo "<div class='featured-image-large'>";
                  echo "<img src='../anh/" . htmlspecialchars($blog['anh']) . "' alt='" . htmlspecialchars($blog['ten_blog']) . "' />";
                  echo "</div>";
                  echo "<h3 class='post-title'>" . htmlspecialchars($blog['ten_blog']) . "</h3>";
                  echo "<time class='post-date'>" . htmlspecialchars($blog['ngay_dang']) . "</time>";
                  echo "</div>";

                  $isFirstDiv = false;
              } else {
                  if (!$isPostGridOpen) {
                      echo "<div class='post-grid'><div class='post-grid-container'>";
                      $isPostGridOpen = true;
                  }
                  echo "<article class='post-card' onclick=\"location.href='$detailUrl';\">";
                  echo "<div class='post-image'>";
                  echo "<img src='../anh/" . htmlspecialchars($blog['anh']) . "' alt='" . htmlspecialchars($blog['ten_blog']) . "' />";
                  echo "</div>";
                  echo "<h4 class='post-card-title'>" . htmlspecialchars($blog['ten_blog']) . "</h4>";
                  echo "<time class='post-card-date'>" . htmlspecialchars($blog['ngay_dang']) . "</time>";
                  echo "</article>";
              }
            }

            if ($isPostGridOpen) {
                echo "</div></div>";
            }
            ?>
            <?php endif; ?>
          </div>
        </div>

        <aside class="sidebar">
          <div class="sidebar-content">
            <div class="sidebar-image">
              <img src="../anh/sale_popup_img.png" alt="sale">
            </div>
            <div class="sidebar-image-secondary">
              <img src="../anh/banner.png" alt="banner.png">
            </div>
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
          </div>
        </aside>
      </div>
    </div>
  </div>
</div>

<?php 
include "../header_footer/footer/footer.php"
?>

</body>
</html>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const images = document.querySelectorAll(".carousel-image");
  let currentIndex = 0;

  setInterval(() => {
    images[currentIndex].classList.remove("active");
    currentIndex = (currentIndex + 1) % images.length;
    images[currentIndex].classList.add("active");
  }, 3000); // Thời gian chuyển ảnh (3 giây)
});
</script>
