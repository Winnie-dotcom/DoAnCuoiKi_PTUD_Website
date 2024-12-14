<?php
// Kết nối cơ sở dữ liệu
include "../db_connection.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
  die("ID đơn hàng không hợp lệ!");
}

// Lấy ID từ URL và đảm bảo an toàn
$id = intval($_GET['id']);

    // Truy vấn dữ liệu
$sql = "
        SELECT 
            dh.id AS ma_don_hang,
            kh.ten_khach_hang,
            dh.thoi_gian,
            dh.trang_thai,
            dh.so_dien_thoai_giao_hang,
            dh.dia_chi_giao_hang,
            sp.ten_san_pham,
            sp.gia_ban,
            sp.anh_minh_hoa,
            ctdh.so_luong,
            (ctdh.so_luong * sp.gia_ban) AS thanh_tien,
            SUM(ctdh.so_luong * sp.gia_ban) OVER (PARTITION BY dh.id) AS tong_tien_don_hang
        FROM don_hang dh
        JOIN khach_hang kh ON dh.id_khach_hang = kh.id
        JOIN chi_tiet_don_hang ctdh ON dh.id = ctdh.id_don_hang
        JOIN san_pham sp ON ctdh.id_san_pham = sp.id
        WHERE dh.id =" .$id;
// Tính tổng tiền đơn hàng
$total_sql = "
    SELECT SUM(ctdh.so_luong * sp.gia_ban) AS tong_tien_don_hang
    FROM chi_tiet_don_hang ctdh
    JOIN san_pham sp ON ctdh.id_san_pham = sp.id
    WHERE ctdh.id_don_hang = $id
";
$total_result = mysqli_query($conn, $total_sql);
$total_row = mysqli_fetch_assoc($total_result);

// Lấy giá trị tổng tiền
$totalOrderAmount = $total_row['tong_tien_don_hang'];


 $query = mysqli_query($conn, $sql);
 $row = mysqli_fetch_assoc($query);
 
 $result = $conn->query($sql);


//Khi nhấn hoàn tất
if(isset($_POST['btn'])){
  $trang_thai = $_POST['trang_thai'];
  $ten_khach_hang = $_POST['ten_khach_hang'];
  $so_dien_thoai_giao_hang = $_POST['so_dien_thoai_giao_hang'];
  $dia_chi_giao_hang = $_POST['dia_chi_giao_hang'];

  // Câu lệnh SQL cập nhật
  $update_sql = "
      UPDATE don_hang
      SET 
          trang_thai = '$trang_thai', 
          so_dien_thoai_giao_hang = '$so_dien_thoai_giao_hang',
          dia_chi_giao_hang = '$dia_chi_giao_hang'
      WHERE id = $id;
  ";
  
  // Thực thi truy vấn
  if (mysqli_query($conn, $update_sql)) {
      // Cập nhật thông tin khách hàng
      $update_kh_sql = "
          UPDATE khach_hang
          SET ten_khach_hang = '$ten_khach_hang'
          WHERE id = (SELECT id_khach_hang FROM don_hang WHERE id = $id)
      ";
      mysqli_query($conn, $update_kh_sql);
        // Chuyển hướng về trang quản lý đơn hàng hoặc hiển thị thông báo thành công
        echo "<script>alert('Cập nhật thành công!'); window.location.href='quan_ly_don.php';</script>";
      } else {
          echo "<script>alert('Cập nhật thất bại: " . mysqli_error($conn) . "');</script>";
}
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Quản lý đơn hàng</title>
    <link rel="stylesheet" href="style_edit_don_hang.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="order-management">
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

        <a href="quan_ly_don.php" class="nav-item active">
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
      <div class="header-section">
        <h1 class="page-title">Đơn hàng</h1>
        <form action="edit_don_hang.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
    <!-- Nội dung form -->
    <button id="submit" name="btn" class="complete-btn">Cập nhật</button>

      </div>
      <div class="form-container">
      <h1>Chi tiết đơn hàng #<?php echo $id; ?></h1>
             <div class="section">
                <div class="two-columns">
                    <div class="column">
                      <h1>Tổng quan</h1>
                      <div class="row">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <label for="date">Ngày tạo đơn:</label>
                        <input type="text" name="date" value="<?php echo $row['thoi_gian']; ?>" readonly>
                      </div>
                      <div class="row">
                        <label for="trang_thai">Trạng thái đơn hàng:</label>
                        <select name="trang_thai">
                            <option value="Đang chờ duyệt" <?php echo ($row['trang_thai'] == 'Đang chờ duyệt') ? 'selected' : ''; ?>>Đang chờ duyệt</option>
                            <option value="Đã duyệt" <?php echo ($row['trang_thai'] == 'Đã duyệt') ? 'selected' : ''; ?>>Đã duyệt</option>
                            <option value="Đã chuẩn bị hàng" <?php echo ($row['trang_thai'] == 'Đã chuẩn bị hàng') ? 'selected' : ''; ?>>Đã chuẩn bị hàng</option>
                            <option value="Đã giao cho đơn vị vận chuyển" <?php echo ($row['trang_thai'] == 'Đã giao cho đơn vị vận chuyển') ? 'selected' : ''; ?>>Đã giao cho đơn vị vận chuyển</option>
                            <option value="Hoàn thành" <?php echo ($row['trang_thai'] == 'Hoàn thành') ? 'selected' : ''; ?>>Hoàn thành</option>
                            <option value="Đã hủy" <?php echo ($row['trang_thai'] == 'Đã hủy') ? 'selected' : ''; ?>>Đã hủy</option>
                        </select>
                      </div>
                    </div>
                    <div class="column">
                    <h1>Khách hàng</h1>
                      <div class="row">
                        <label for="ten_khach_hang">Tên khách hàng:</label>
                        <input type="text" name="ten_khach_hang" value="<?php echo $row['ten_khach_hang']; ?>">
</div>
                      <div class="row">
                        <label for="so_dien_thoai">Số điện thoại:</label>
                        <input type="text"  name="so_dien_thoai_giao_hang" value="<?php echo $row['so_dien_thoai_giao_hang']; ?>">                      </div>
                    </div>
                </div>
            </div>
            <div class="section">
            <h1>Vận chuyển</h1>
                <label for="address">Địa chỉ:</label>
                <input type="text" id="dia_chi_giao_hang" name="dia_chi_giao_hang" value="<?php echo $row['dia_chi_giao_hang']; ?>">            </div>
        </form>
    </div>
      <div class="orders-products">
        <table class="product-table">
          <thead>
            <tr>
                      <th>Sản phẩm</th>
                      <th>Giá</th>
                      <th>Số lượng</th>
                      <th>Tổng cộng</th>
            </tr>
          </thead>
          <tbody>
            <?php
              // Kiểm tra xem có dữ liệu trả về không
              if ($result->num_rows > 0) {
                // Xuất dữ liệu ra bảng
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>"; 
                  echo "<td> <img src='../anh/" . $row['anh_minh_hoa'] . "' alt=" . $row['ten_san_pham'] . ">";
                  echo  $row['ten_san_pham'] . "</td>";
                  echo "<td>". number_format($row['gia_ban'], 0, ',', '.') . " ₫</td>"; // Định dạng giá tiền
                  echo "<td>". $row['so_luong'] . "</td>";
                  echo "<td>". number_format($row['thanh_tien'], 0, ',', '.') . " ₫</td>"; // Định dạng giá tiền
                  echo "</tr>";
                }
              } else {
                echo "Không có dữ liệu.";
              }            
            ?>
          </tbody>
        </table>
          <div class="shipping-fee">
              <span>Vận chuyển</span>
              <span>30.000 ₫</span>
          </div>
          <div class="order-summary">
              <div>
                  <span>Tổng sản phẩm:</span>
                  <span>
          <?php 
          if ($totalOrderAmount > 0) {
              echo number_format($totalOrderAmount, 0, ',', '.'); 
          } else {
              echo "Không có dữ liệu.";
          }
          ?> ₫
      </span>            
    </div>
              <div>
                  <span>Vận chuyển:</span>
                  <span>30.000 ₫</span>
              </div>
              <div class="total">
                  <span>Tổng đơn hàng:</span>
                  <span>
          <?php 
          if ($totalOrderAmount > 0) {
              echo number_format($totalOrderAmount + 30000, 0, ',', '.'); 
          } else {
              echo "Không có dữ liệu.";
          }
          ?> ₫
      </span>            
    </div>
        </div>
      </div>
    </main>
  </div>
</div>  