<?php
session_start();  // Bắt đầu session

// Kiểm tra xem người dùng đã đăng nhập chưa
$isLoggedIn = isset($_SESSION['id']) && !empty($_SESSION['id']); // Biến xác định trạng thái đăng nhập
?>