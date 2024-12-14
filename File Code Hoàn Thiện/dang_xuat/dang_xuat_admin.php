<?php
session_start();  // Khởi động session
session_destroy();  // Hủy session
header("Location: ../dang_nhap_admin/dang_nhap_admin.php");  // Chuyển về trang đăng nhập
exit;
?>