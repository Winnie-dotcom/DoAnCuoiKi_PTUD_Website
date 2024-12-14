<head>
  <?php
include "../db_connection.php";
include "../kiem_tra_dang_nhap.php";
if ($isLoggedIn == NULL) {
  include_once "../header_footer/header/chua_login.php";
}
else {
  include_once "../header_footer/header/da_login.php";
}
?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
  <link rel="stylesheet" href="gio_hang.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>


<main class="cart-content">
    <!--Header ở đâyyyy-->
    <div class="cart-header">
      <h1 class="cart-title">Giỏ Hàng</h1>
      <a href ="../danh_sach_san_pham/danh_sach_san_pham.php">
      <button class="add-more">
      <svg 
      fill="currentColor" 
      width="20" 
      height="20" 
      xmlns="http://www.w3.org/2000/svg" 
      viewBox="0 0 448 512">
      <path 
        d="M432 256C432 264.8 424.8 272 416 272h-176V448c0 8.844-7.156 16.01-16 16.01S208 456.8 208 448V272H32c-8.844 0-16-7.15-16-15.99C16 247.2 23.16 240 32 240h176V64c0-8.844 7.156-15.99 16-15.99S240 55.16 240 64v176H416C424.8 240 432 247.2 432 256z">
      </path>
    </svg>
        <span class="add-text">Mua Thêm</span>
      </button>
      </a>
    </div>
<!--List sản phẩm ở đai-->
    <div class="cart-items">
      <div class="cart-layout">
        <div class="items-column">
          <div class="items-container">
            <div class="items-header">
              <div>Sản Phẩm</div>
              <div class="header-labels">
                <div class="price-label">Đơn Giá</div>
                <div>Số Lượng</div>
                <div class="total-label">Thành Tiền</div>
              </div>
              <!-- Nút Xóa tất cả sản phẩm -->
              <button class="delete-all">
              <a href="xoatatca.php">
              <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/55005eb07e2961021e93bea8457c884d2056f0178ff7f2f1cd5e816db1c8a990?placeholderIfAbsent=true&amp;apiKey=b6e0d90081164f119e3e35a2c6b9da11" class="remove-icon" alt="Remove item">
              </a>            
            </button>
            </div>

            <!-- Vị trí PHP code được chèn vào để hiển thị sản phẩm -->
            <div class="items-list">
                <?php
                    $id_khach_hang = $_SESSION['id']; // Lấy id khách hàng từ session
                    $id_khach_hang = $conn->real_escape_string($id_khach_hang); // Thoát dữ liệu để tránh SQL Injection

                    // Câu truy vấn để nhóm sản phẩm và cộng dồn số lượng
                    $sql = "SELECT gio_hang.id_khach_hang, gio_hang.id_san_pham, SUM(gio_hang.so_luong) AS tong_so_luong, 
                                  san_pham.ten_san_pham, san_pham.gia_ban
                            FROM gio_hang
                            JOIN san_pham ON gio_hang.id_san_pham = san_pham.id
                            JOIN khach_hang ON khach_hang.id = gio_hang.id_khach_hang
                            WHERE khach_hang.id = '$id_khach_hang'
                            GROUP BY gio_hang.id_san_pham, san_pham.ten_san_pham, san_pham.gia_ban";

                    $result = $conn->query($sql);
                    $tong_tien = 0; // Khởi tạo biến tổng tiền
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $thanh_tien = $row['tong_so_luong'] * $row['gia_ban']; // Tính thành tiền cho từng sản phẩm
                            $tong_tien += $thanh_tien; // Cộng vào tổng tiền

                            echo "<div class='item'>";
                            echo "<div class='product-name'>" . htmlspecialchars($row['ten_san_pham']) . "</div>";
                            echo "<div class='price'>" . number_format($row['gia_ban'], 0, ',', '.') . "đ</div>";
                            echo "<div class='quantity'>" . htmlspecialchars($row['tong_so_luong']) . "</div>";
                            echo "<div class='total'>" . number_format($thanh_tien, 0, ',', '.') . "đ</div>";
                            // Nút Xóa sản phẩm
                            echo "<div class='remove-item'><a href='xoasp.php?id=" . $row['id_san_pham'] . "'><img src='https://cdn.builder.io/api/v1/image/assets/TEMP/55005eb07e2961021e93bea8457c884d2056f0178ff7f2f1cd5e816db1c8a990?placeholderIfAbsent=true&amp;apiKey=b6e0d90081164f119e3e35a2c6b9da11' alt='Remove item' class='remove-icon'></a></div>";
                            echo "</div>";
                        }
                    } else {
                        echo "Giỏ hàng của bạn trống.";
                    }
                ?>
            </div>

                </div>
            </div>

            <div class="summary-column">
                <div class="summary-container">
                    <div class="summary-content">
                        <div class="summary-labels">
                            <div>Tạm Tính</div>
                            <div style="margin-top: 30px;">Tổng Tiền</div>
                        </div>
                        <div class="summary-values">
                        <div><?php echo number_format($tong_tien, 0, ',', '.'); ?>đ</div>
                        <div style="margin-top: 31px;"><?php echo number_format($tong_tien, 0, ',', '.'); ?>đ</div>
                        </div>
                    </div>
                    <a href="../xac_nhan_don_hang/xac_nhan_don_hang.php">
                    <button class="checkout-btn">Mua Hàng</button>
                          </a>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
include "../header_footer/footer/footer.php";
?>