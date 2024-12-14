<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng nhập</title>
  <link rel="stylesheet" href="dang_nhap_khach_hang.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
  <script src="dang_nhap_khach_hang.js" defer></script>
</head>

<body>
<?php
session_start(); // Khởi động session
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_name = $_POST['user_name'];
    $mat_khau = $_POST['mat_khau'];

    // Truy vấn thông tin người dùng
    $sql = "SELECT id, user_name, mat_khau FROM khach_hang WHERE user_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Lấy dữ liệu từ kết quả truy vấn
        $user = $result->fetch_assoc();
        $hashed_password_from_db = $user['mat_khau'];
        $id = $user['id'];

        // Kiểm tra mật khẩu
        if (password_verify($mat_khau, $hashed_password_from_db)) {
            // Đăng nhập thành công
            $_SESSION['user_name'] = $user_name; // Lưu tên đăng nhập vào session
            $_SESSION['id'] = $id; // Lưu id vào session
            echo"<script>
                // Quay lại 2 trang trong lịch sử trình duyệt
                window.history.go(-2);
            </script>";
        } else {
            echo "<script>alert('Mật khẩu không chính xác');</script>";
        }
    } else {
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
            <input type="text" name="user_name" id="username" class="form-input" placeholder="Nhập vào tên đăng nhập" required aria-required="true">
          </div>
        </div>

        <div class="input-group">
          <div class="input-wrapper">
            <label for="password" class="input-label">Mật khẩu</label>
            <div class="password-container">
              <input type="password" id="password" name="mat_khau" class="form-input" placeholder="Nhập vào mật khẩu" required aria-required="true">
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