<?php
session_start();  // Khởi động session
session_destroy();  // Hủy session
echo '<script>window.history.back();</script>'; // Chuyển về trang đăng nhập
exit;
?>