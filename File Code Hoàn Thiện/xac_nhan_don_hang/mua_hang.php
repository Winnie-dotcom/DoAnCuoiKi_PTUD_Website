<?php
include "../db_connection.php";
include "../kiem_tra_dang_nhap.php";
// Kiểm tra nếu dữ liệu được gửi qua POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Nhận dữ liệu từ FormData
    $ten = $_POST['ten'];
    $sdt = $_POST['sdt'];
    $tpho = $_POST['tpho'] ;
    $qh = $_POST['qh']; 
    $px = $_POST['px'];
    $diachi = $_POST['diachi'];
    $ghichu = $_POST['ghichu'];
    $id_khach_hang = $_SESSION['id'];

    // Thực hiện các thao tác với dữ liệu (lưu vào DB, gửi email, v.v.)
    // Ví dụ:
    $full_diachi = $diachi . "," . $px . "," . $qh . "," . $tpho;

    $sql = "INSERT INTO don_hang ( id_khach_hang, so_dien_thoai_giao_hang, dia_chi_giao_hang, trang_thai, ghi_chu)
    VALUES ('$id_khach_hang','$sdt','$full_diachi','Chờ xác nhận','$ghichu')";

    if (mysqli_query($conn, $sql)) {
       // Lấy ID của đơn hàng vừa được thêm
       $id_don_hang = mysqli_insert_id($conn);

       // Lấy danh sách sản phẩm từ giỏ hàng
       $sql_cart = "SELECT id_san_pham, SUM(so_luong) AS tong_so_luong 
                    FROM gio_hang  
                    WHERE id_khach_hang = '$id_khach_hang'
                    GROUP BY id_san_pham";
       $result_cart = $conn->query($sql_cart);

       $tong_so_luong_don_hang = 0;

       if ($result_cart->num_rows > 0) {
           while ($row = $result_cart->fetch_assoc()) {
               $id_san_pham = $row['id_san_pham'];
               $so_luong = $row['tong_so_luong'];

               $tong_so_luong_don_hang += $so_luong;

                // Cập nhật số lượng sản phẩm trong kho
                $sql_update_stock = "UPDATE san_pham 
                                     SET so_luong_trong_kho = so_luong_trong_kho - $so_luong 
                                     WHERE id = '$id_san_pham'";
                mysqli_query($conn, $sql_update_stock); // Thực thi câu lệnh cập nhật kho

               // Lấy giá bán từ bảng sản phẩm
               $sql_price = "SELECT gia_ban, ten_san_pham FROM san_pham WHERE id = '$id_san_pham'";
               $result_price = $conn->query($sql_price);

               if ($result_price->num_rows > 0) {
                   $row_price = $result_price->fetch_assoc();
                   $gia_ban = $row_price['gia_ban'];
                   $ten_san_pham = $row_price['ten_san_pham'];

                   // Thêm vào bảng chi_tiet_don_hang
                   $sql_order_detail = "INSERT INTO chi_tiet_don_hang (id_don_hang, id_san_pham, ten_san_pham, so_luong) 
                                       VALUES ('$id_don_hang', '$id_san_pham', '$ten_san_pham', '$so_luong')";
                   mysqli_query($conn, $sql_order_detail);
               }
           }
       }

       echo "<script>alert('Đơn Hàng Của Bạn Đã Được Xác Nhận Thành Công');
       window.location.href = '../trangchu/trangchu.php';
       </script>";
   } else {
       echo "<script>alert('Có lỗi xảy ra khi tạo đơn hàng. Vui lòng thử lại sau!');</script>";
   }
}
$conn->close();
?>
