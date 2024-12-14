<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng nhập</title>
  <link rel="stylesheet" href="dang_nhap_admin.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

  <script src="dang_nhap_admin.js" defer></script>
</head>

<body>
<?php
// Kết nối đến cơ sở dữ liệu
include '../db_connection.php';

session_start(); // Khởi động session để lưu thông tin khách hàng

// Kiểm tra xem form đã được gửi chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Truy vấn cơ sở dữ liệu để lấy mật khẩu đã mã hóa của người dùng
    $sql = "SELECT password , username FROM admin_account WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

     // Kiểm tra nếu người dùng tồn tại trong cơ sở dữ liệu
     if (mysqli_num_rows($result) > 0) {
      // Lấy mật khẩu đã mã hóa từ cơ sở dữ liệu
      $row = mysqli_fetch_assoc($result);
      $hashed_password_from_db = $row['password'];

      // Kiểm tra mật khẩu người dùng nhập vào với mật khẩu đã mã hóa
      if (password_verify($password, $hashed_password_from_db)) {
          // Đăng nhập thành công, chuyển hướng người dùng đến trang khác
          session_start();
          $_SESSION['username'] = $username; // Lưu thông tin người dùng vào session
          header("Location: ../backend_san_pham/backend_san_pham.php");
          exit();
      } else {
          // Mật khẩu không đúng
          echo "<script>alert('Mật khẩu không chính xác');</script>";
      }
  } else {
      // Tên đăng nhập không tồn tại
      echo "<script>alert('Tên đăng nhập không tồn tại');</script>";
  }
}
$conn->close();
?>

  <div class="login-form-wrapper">
      <div class="login-title-wrapper">
        <h1 class="login-title">Đăng nhập</h1>
        <div class="divider" role="separator"></div>
      </div>
      <form class="login-form" role="form" action="" method="post">
        <div class="input-group">
          <div class="input-wrapper">
            <label for="username" class="input-label">Tên đăng nhập</label>
            <input type="text" name="username" id="username" class="form-input" placeholder="Nhập vào tên đăng nhập" required aria-required="true">
          </div>
        </div>

        <div class="input-group">
          <div class="input-wrapper">
            <label for="password" class="input-label">Mật khẩu</label>
            <div class="password-container">
              <input type="password" id="password" name="password" class="form-input" placeholder="Nhập vào mật khẩu" required aria-required="true">
              <div class="toggle-password" id="togglePassword">
                <img src="anh/eye_look.png" alt="Show Password" class="eye-icon show-password">
                <img src="anh/eye_slash.png" alt="Hide Password" class="eye-icon hide-password">
              </div>
            </div>
          </div>
        </div>


        <div class="submit-button">
          <button type="submit" class="button">Đăng nhập</button>
        </div>
      </form>
  </div>
</body> 