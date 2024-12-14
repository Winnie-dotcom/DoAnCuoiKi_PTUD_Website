<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng ký</title>
  <link rel="stylesheet" href="dang_ky.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
  <script src="dang_ky.js" defer></script>
</head>

<body>
<?php
  // Kết nối đến cơ sở dữ liệu
  include '../db_connection.php';

  session_start(); // Khởi động session để lưu thông tin khách hàng

  // Khi nhấn nút Đăng ký
  if (isset($_POST['button'])) {
    $user_name = $_POST['user_name'];
    $mat_khau = $_POST['mat_khau'];
    $ten_khach_hang = $_POST['ten_khach_hang'];
    $gioi_tinh = $_POST['gioi_tinh'];
    $ngay_sinh = $_POST['ngay_sinh'];
    $so_dien_thoai = $_POST['so_dien_thoai'];
    $email = $_POST['email'];
    $xac_nhan_mat_khau = $_POST['xac_nhan_mat_khau'];

    // Kiểm tra nếu mật khẩu và xác nhận mật khẩu trùng khớp
    if ($mat_khau !== $xac_nhan_mat_khau) {
      echo "<script>
              alert('Mật khẩu và xác nhận mật khẩu không trùng khớp!');
              window.history.back();
            </script>";
    } else {
        // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
        $hashed_password = password_hash($mat_khau, PASSWORD_DEFAULT); 

        // Câu lệnh SQL
        $stmt = $conn->prepare("INSERT INTO khach_hang (user_name, mat_khau, ten_khach_hang, gioi_tinh, ngay_sinh, so_dien_thoai, email) 
                               VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $user_name, $hashed_password, $ten_khach_hang, $gioi_tinh, $ngay_sinh, $so_dien_thoai, $email);

        if ($stmt->execute()) {
          echo "<script>
                  alert('Đăng ký tài khoản thành công!');
                  location.href = '../trangchu/trangchu.php';
                </script>";
        } else {
          echo "<script>
                  alert('Lỗi: " . $stmt->error . "');
                  window.history.back();
                </script>";
        }

        $stmt->close();
      }
    }
  mysqli_close($conn); // Đảm bảo đóng kết nối
?>



  <div class="registration-form-wrapper">
      <div class="registration-title-wrapper">
        <h1 class="registration-title">Đăng ký</h1>
        <div class="divider" role="separator"></div>
      </div>

      <form class="registration-form" role="form" action="" method="post">
        <div class="input-group">
          <label for="fullname" class="visually-hidden">Họ tên</label>
          <div class="input-wrapper">
          <label for="username" class="input-label">Họ tên</label>
            <input type="text" id="fullname" name="ten_khach_hang" class="input-field" placeholder="Nhập vào họ tên" required />
          </div>
        </div>

        <div class="input-group">
          <label for="gender" class="visually-hidden">Giới tính</label>
          <div class="input-wrapper">
              <span class="input-label">Giới tính</span>
              <select id="gender" name="gioi_tinh" class="input-field" required>
                <option value="">Chọn</option>
                <option value="male">Nam</option>
                <option value="female">Nữ</option>
              </select>
          </div>
        </div>

        <div class="input-group">
          <label for="birthdate" class="visually-hidden">Ngày sinh</label>
          <div class="input-wrapper">
            <span class="input-label">Ngày sinh</span>
            <input type="date" id="birthdate" name="ngay_sinh" class="input-field" required />
          </div>
        </div>

        <div class="input-group">
          <label for="phone" class="visually-hidden">Số điện thoại</label>
          <div class="input-wrapper">
            <span class="input-label">Số điện thoại</span>
            <input type="tel" id="phone" name="so_dien_thoai" class="input-field" placeholder="Nhập vào số điện thoại" required />
          </div>
        </div>

        <div class="input-group">
          <label for="email" class="visually-hidden">Email</label>
          <div class="input-wrapper">
            <span class="input-label">Email</span>
            <input type="email" id="email" name="email" class="input-field" placeholder="Nhập vào email của bạn" required />
          </div>
        </div>

        <div class="input-group">
          <label for="username" class="visually-hidden">Tên đăng nhập</label>
          <div class="input-wrapper">
            <span class="input-label">Tên đăng nhập</span>
            <input type="text" id="username" name="user_name" class="input-field" placeholder="Nhập vào tên cho mỗi lần đăng nhập" required />
          </div>
        </div>

        <div class="input-group">
          <div class="input-wrapper">
            <label for="password" class="input-label">Mật khẩu</label>
            <div class="password-container">
              <input type="password" id="password" name="mat_khau" class="input-field" placeholder="Nhập vào mật khẩu" required aria-required="true">
              <div class="toggle-password" id="togglePassword">
                <img src="anh/eye_look.png" alt="Show Password" class="eye-icon show-password">
                <img src="anh/eye_slash.png" alt="Hide Password" class="eye-icon hide-password">
              </div>
            </div>
          </div>
        </div>

        <div class="input-group">
        <div class="input-wrapper">
          <label for="confirm_password" class="input-label">Xác nhận mật khẩu</label>
          <div class="password-container">
            <input type="password" id="confirm_password" name="xac_nhan_mat_khau" class="input-field" placeholder="Nhập lại mật khẩu" required aria-required="true">
            <div class="toggle-password" id="toggleConfirmPassword">
              <img src="anh/eye_look.png" alt="Show Password" class="eye-icon show-password">
              <img src="anh/eye_slash.png" alt="Hide Password" class="eye-icon hide-password">
            </div>
          </div>
        </div>
      </div>

        <div class="submit-button">
          <button type="submit" class="button" name="button">Đăng ký</button>
        </div>
      </form>
  </div>
</body>