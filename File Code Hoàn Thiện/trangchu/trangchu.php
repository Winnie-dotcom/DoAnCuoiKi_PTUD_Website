<?php 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="trangchu_2.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ</title>
</head>
<?php
include "../kiem_tra_dang_nhap.php";
if ($isLoggedIn == NULL) {
  include_once "../header_footer/header/chua_login.php";
}
else {
  include_once "../header_footer/header/da_login.php";
}
?>

<body>
    <!-- banner -->
    <div class="banner">
        <img src="banner.jpg" alt="banner" id="anh_banner">
    </div>

    <!-- 3 ảnh feature -->
    <div class="featured-images">
        <div class="image-row">
            <div class="featured-image">
                <img src="hinh_1.jpg" alt="Hình 1">
            </div>
            <div class="featured-image">
                <img src="hinh_2.jpg" alt="Hình 2">
            </div>
            <div class="featured-image">
                <img src="hinh_3.jpg" alt="Hình 3">
            </div>
        </div>
    </div>
    
    <!-- 4 phúc lợi khi đặt hàng BTJ -->
    <section class="features-grid">
        <div class="feature-card">
          <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/1598b1edbc0264fdc9bd1373787ed9219a2fef3d942ebde62f628d466b02053a?placeholderIfAbsent=true&apiKey=7e0415f8269748eea2b629ddfee9d64a" alt="" class="feature-icon" />
          <h3 class="feature-title">KHÁCH HÀNG THÂN THIẾT</h3>
          <p class="feature-description">Nhận ưu đãi đặc biệt dành cho khách hàng thân thiết</p>
        </div>
        
        <div class="feature-card">
          <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/bf83f23946e725d5771534ee64ba31f9838a73c68706f696d95b04354f2f2849?placeholderIfAbsent=true&apiKey=7e0415f8269748eea2b629ddfee9d64a" alt="" class="feature-icon" />
          <h3 class="feature-title">GIAO HÀNG NHANH CHÓNG</h3>
          <p class="feature-description">Nhận ưu đãi đặc biệt dành cho khách hàng thân thiết</p>
        </div>
        
        <div class="feature-card">
          <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/45ee30ed3bbd9b32445776b4002f054753a551faa464e37ce97b6ea36cd1dc67?placeholderIfAbsent=true&apiKey=7e0415f8269748eea2b629ddfee9d64a" alt="" class="feature-icon" />
          <h3 class="feature-title">CHÍNH SÁCH BẢO HÀNH</h3>
          <p class="feature-description">Nhận ưu đãi đặc biệt dành cho khách hàng thân thiết</p>
        </div>
        
        <div class="feature-card">
          <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/24e3fefc92daf6854c5e2b00e672ef6095823d6ae2fba21d2f066e0569c2b821?placeholderIfAbsent=true&apiKey=7e0415f8269748eea2b629ddfee9d64a" alt="" class="feature-icon" />
          <h3 class="feature-title">CHĂM SÓC TẬN TÌNH</h3>
          <p class="feature-description">Nhận ưu đãi đặc biệt dành cho khách hàng thân thiết</p>
        </div>
      </section>

      <!-- Giới thiệu -->
<div class="about-section">
    <div class="about-content">
        <div class="about-text">
            <h2 class="about-title">BTJ - Thổi hồn câu chuyện vào từng món trang sức</h2>
            <div class="title-underline"></div>
            <p class="about-description">
                Tại BTJ, chúng tôi mang đến cho bạn hơn cả những phụ kiện lấp lánh, mà là những tác phẩm nghệ thuật chứa đựng những cung bậc cảm xúc và giá trị riêng biệt. 
                Lấy cảm hứng từ văn hóa, lịch sử, thiên nhiên và những trải nghiệm cá nhân, BTJ biến những câu chuyện bình dị thành những thiết kế độc đáo, sang trọng và giá cả phải chăng. 
                Mỗi món trang sức BTJ là một giai điệu cảm xúc, dẫn dắt bạn đến những miền ký ức đẹp đẽ và khơi gợi những rung cảm tinh tế.
                <br /><br />
                Giờ đây, bạn đã có thể tự tay biến chúng thành hiện thực, biến câu chuyện của bạn trở thành một người đồng hành bằng cách tự thiết kế những mẫu trang sức cho riêng mình.
                <br />
                BTJ không chỉ là nơi bạn tìm kiếm trang sức, mà còn là nơi bạn tìm thấy chính mình.
            </p>
            <a href ="../danh_sach_san_pham/danh_sach_san_pham.php" class="cta-button">Xem cửa hàng</a>
        </div>
       
            <img src="aboutus.jpg" class="about-image">
        
    </div>
</div>


</body>

<?php 
include "../header_footer/footer/footer.php"
?>


</html>
