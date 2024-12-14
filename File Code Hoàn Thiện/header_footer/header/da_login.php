<?php
    $current_page = basename($_SERVER['PHP_SELF']); // Lấy tên file PHP hiện tại
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
                /* Đặt cấu hình chung */
        body {
            margin: 0; /* Loại bỏ toàn bộ margin mặc định của body */
            padding: 0; /* Loại bỏ toàn bộ padding mặc định của body */
            box-sizing: border-box; /* Áp dụng box-sizing để tính toán chính xác kích thước phần tử */
        }

        header {
            margin:0;
            padding:0;
            display: flex;
            flex-direction: row;
            justify-content: space-between; /* Dàn đều hai bên */
            align-items: center; /* Canh giữa theo chiều dọc */
        }

        /* Header */
        .thanh_header {
            background-color: #680707;
            display: flex;
            justify-content: space-between; /* Tách đều các phần tử */
            align-items: center;
            height: 50px;
            padding: 0 25px;
            width:100%;
        }

        .header_logo #logo {
            height: 40px;
            margin-right: 8px;
        }


        .dieu_huong {
            display: flex;
            gap: 10px; /* Khoảng cách giữa các liên kết */
        }

        .dieu_huong a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            font-family: 'Montserrat', sans-serif;
            margin:20px;
        }

        .dieu_huong a:hover {
            font-weight: bold;
        }

        /* Định nghĩa trạng thái active */
        .dieu_huong a.active {
            /* Đổi màu chữ thành vàng */
            font-weight: bold; /* Tô đậm chữ */
        }

        /* Để hiệu ứng mượt mà */
        .dieu_huong a {
            transition: color 0.3s ease, font-weight 0.3s ease;
        }

        .header_2 {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .cart-icon {
            width: 32px;
            height: 32px;
            object-fit: contain;
        }

        .cart-icon {
            transition: transform 0.3s ease;
        }
        
        .cart-icon:hover {
            transform: scale(1.1);
        }

    
         #dang_xuat {
            color: rgb(131, 9, 9);
            text-decoration: none;
            font-size: 16px;
            font-family: 'Montserrat', sans-serif;
            background-color: rgb(255, 243, 243);
            padding: 7px;
            border-radius: 7px;
        }

        @media (max-width: 425px) {
            .thanh_header {
                display: flex;
                flex-direction: column; /* Xếp các phần tử theo chiều dọc */
                align-items: center; /* Căn giữa các phần tử theo chiều ngang */
                padding: 10px; /* Tăng khoảng cách giữa nội dung */
                height: auto; /* Tự động điều chỉnh chiều cao */
                width: 100%;
            }

            .header_logo #logo {
                height: 25px; /* Giảm kích thước logo */
                margin-right: 3px; /* Giảm khoảng cách bên phải logo */
            }

            .dieu_huong {
                display: flex;
                flex-direction: column; /* Liên kết nằm ngang */
                flex-wrap: nowrap; /* Ngăn xuống hàng */
                gap: 1px; /* Giảm khoảng cách giữa các liên kết */
                width: 100%;
            }

            .dieu_huong a {
                font-size: 9px; /* Giảm kích thước chữ */
                padding: 3px; /* Giảm padding */
                white-space: nowrap; /* Ngăn không cho văn bản xuống dòng */
                gap:1px;
            }

            .blog, .san_pham, .trang_chu{
                display: flex;
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            height: 38px; /* Ensure it takes the full height of the parent */
            /* Ensure it takes the full width of the parent */
            }

            .header_2 {
                width: 100%; /* Chiếm toàn bộ chiều ngang */
                display: flex;
                justify-content: flex-end; /* Đẩy nút sang bên phải */
                align-items: center; /* Căn giữa theo chiều dọc */
                padding-right: 20px; /* Cách lề phải 20px */
                gap: 10px; /* Khoảng cách giữa các nút */
            }

            #dang_xuat {
                font-size: 9px; /* Giảm kích thước chữ */
                padding: 4px 5px; /* Thu nhỏ padding */
                border-radius: 4px; /* Bo tròn nhẹ hơn */
                width: auto; /* Chỉ vừa với nội dung */
                margin:10px 0;
                white-space: nowrap;
                gap:2px;
                right: 10px;
                top: 10px;
                
            }


            .cart-icon {
                width: 70px; /* Giảm kích thước giỏ hàng */
                height: 20px;
            }
        }

    </style>
</head>
<header>
        <div class="thanh_header">
            <div class="header_logo">
                <img src="logo.jpg" id="logo" alt="LOGO">
            </div>
            <div class="header_1">
                <nav class="dieu_huong">
                    <div class="trang_chu">
                        <a href="../trangchu/trangchu.php" class="<?= $current_page == 'trangchu.php' ? 'active' : '' ?>"> Trang Chủ </a>
                    </div>
                    <div class="san_pham">
                        <a href="../danh_sach_san_pham/danh_sach_san_pham.php" class="<?= $current_page == 'danh_sach_san_pham.php' ? 'active' : '' ?>"> Sản phẩm </a>
                    </div>
                    <div class="blog">
                        <a href="../blog/blog.php" class="<?= $current_page == 'blog.php' ? 'active' : '' ?>"> Blog</a>
                    </div>
                </nav>
            </div>
            <div class="header_2">
                    <a href="../gio_hang/gio_hang.php">
                        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/da5e0c7a8bfef1affe41e9fbaf155451b1054255b208fd6b274bc0e715b039f0?placeholderIfAbsent=true&apiKey=7e0415f8269748eea2b629ddfee9d64a"
                                 alt="" class="cart-icon">
                    </a>
                    <a href="../dang_xuat/dang_xuat_khach_hang.php" id="dang_xuat"> Đăng xuất</a>
            </div>
        </div>
</header>

</html>
