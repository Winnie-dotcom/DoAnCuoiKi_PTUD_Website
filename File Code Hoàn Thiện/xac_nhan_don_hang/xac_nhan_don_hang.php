<head>
    <link rel="stylesheet" href="xac_nhan_don_hang.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
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
</head>

<main class="main-content">
    <form method="post" action="mua_hang.php">
        <h1 class="tieu-de">Xác Nhận Đơn Hàng</h1>
        <div class="content-wrapper">
            <!-- Nửa trái -->
            <div class="left-section">
                <!-- Thông tin khách hàng -->
                <section class="order-details">
                    <div class="customer-info">
                        <h2 class="section-title">Thông Tin Khách Hàng</h2>
                        <div class="tt">
                            <input type="text" id="customerName" class="form-input" name="ten" placeholder="Tên khách hàng" required />
                            <input type="tel" id="phoneNumber" class="form-input" name="sdt" placeholder="Số điện thoại" required />
                        </div>
                    </div>
                    <br>
                    <div class="shipping-info">
                        <h2 class="section-title">Địa Chỉ Nhận Hàng</h2>
                        <input type="text" id="city" class="form-input" name="tpho" placeholder="Tỉnh/Thành phố" required />
                        <div class="form-row">
                            <input type="text" id="district" class="form-input" name="qh" placeholder="Quận/Huyện" required />
                            <input type="text" id="ward" class="form-input" name="px" placeholder="Phường/Xã" required />
                        </div>
                        <input type="text" id="address" class="form-input" name="diachi" placeholder="Địa chỉ nhận hàng" required />
                    </div>
                </section>
                <br>
                <section class="products-section">
                    <h2 class="section-title">Sản Phẩm</h2>
                    <div class="product-header">
                        <span>Sản Phẩm</span>
                        <div class="product-details">
                            <span>Giá</span>
                            <span>Số Lượng</span>
                            <span>Thành Tiền</span>
                        </div>
                    </div>
                    <?php
                    $id_khach_hang = $_SESSION['id'];
                    $id_khach_hang = $conn->real_escape_string($id_khach_hang);
                    $sql = "SELECT gio_hang.id_khach_hang, gio_hang.id_san_pham, SUM(gio_hang.so_luong) AS tong_so_luong, san_pham.ten_san_pham, san_pham.gia_ban
                            FROM gio_hang
                            JOIN san_pham ON gio_hang.id_san_pham = san_pham.id
                            WHERE gio_hang.id_khach_hang = '$id_khach_hang'
                            GROUP BY gio_hang.id_san_pham, san_pham.ten_san_pham, san_pham.gia_ban";
                    $result = $conn->query($sql);
                    $tong_tien = 0;
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $thanh_tien = $row['tong_so_luong'] * $row['gia_ban'];
                            $tong_tien += $thanh_tien;
                            echo "<div class='product-item'>";
                            echo "<span class='xd'>" . htmlspecialchars($row['ten_san_pham']) . "</span>";
                            echo "<div class='product-details'>";
                            echo "<span>" . number_format($row['gia_ban'], 0, ',', '.') . "đ</span>";
                            echo "<span>x" . htmlspecialchars($row['tong_so_luong']) . "</span>";
                            echo "<span>" . number_format($thanh_tien, 0, ',', '.') . "đ</span>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                        echo "<p>Giỏ hàng của bạn trống.</p>";
                    }                    
                    ?>
                </section>
            </div>
            <!-- Nửa phải -->
            <div class="right-section">
                <div class="payment-section">
                    <h2 class="section-title">Phương Thức Thanh Toán</h2>
                    <div class="payment-method">
                        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/70f5badfddc7c6b4f4574527f318976c06af1e83ca980958051b5281148c39b7?placeholderIfAbsent=true&apiKey=b6e0d90081164f119e3e35a2c6b9da11" alt="Thanh toán" class="payment-icon" />
                        <span>Thanh toán khi nhận hàng</span>
                    </div>
                </div>
                <div class="notes-section">
                    <h2 class="section-title">Ghi Chú</h2>
                    <textarea id="orderNotes" class="form-input" name="ghichu" placeholder="Thêm ghi chú (tuỳ chọn)"></textarea>
                </div>
                <div class="total-section">
                    <h2 class="section-title">Chi tiết thanh toán</h2>
                    <div class="total-row total-row-border">
                        <span>Tổng tiền hàng</span>
                        <span><?php echo number_format($tong_tien, 0, ',', '.'); ?>đ</span>
                    </div>
                    <div class="total-row">
                        <span>Tổng Tiền thanh toán</span>
                        <span><?php echo number_format($tong_tien, 0, ',', '.'); ?>đ</span>
                    </div>
                    <br>
                    <div class="button">
                        <button class="checkout-btn" type="submit" name="btn">Mua Hàng</button>
                    </div>
                </div>
                <div class="terms">
                    <input type="checkbox" id="terms" class="checkbox" name="check" required />
                    <label for="terms">Tôi đồng ý với các Điều kiện giao dịch chung của website</label>
                </div>
            </div>
        </div>
    </form>
</main>

<?php
include "../header_footer/footer/footer.php";
?>

<script>
// Hàm kiểm tra khi người dùng nhấn nút "Mua Hàng"
document.getElementById("btn").addEventListener("click", function(event) {
    // Lấy thông tin từ các trường input
    const customerName = document.getElementById("customerName").value;
    const phoneNumber = document.getElementById("phoneNumber").value;
    const city = document.getElementById("city").value;
    const district = document.getElementById("district").value;
    const ward = document.getElementById("ward").value;
    const address = document.getElementById("address").value;
    const termsChecked = document.getElementById("terms").checked;

    // Kiểm tra nếu thông tin chưa đầy đủ hoặc checkbox chưa được tick
    if (!customerName || !phoneNumber || !city || !district || !ward || !address) {
        alert("Vui lòng nhập đầy đủ thông tin.");
        event.preventDefault(); // Ngừng việc gửi form
    } else if (!termsChecked) {
        alert("Bạn cần đồng ý với các Điều kiện giao dịch.");
        event.preventDefault(); // Ngừng việc gửi form
    } else {
        document.querySelector('form').reset(); // Reset form
    }
});
</script>