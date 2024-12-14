<?php
include "../db_connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $ten_blog = $_POST['ten_blog'];
    $tac_gia = $_POST['tac_gia'];
    $ngay_dang = $_POST['ngay_dang'];
    $noi_dung = $_POST['noi_dung'];

    // Xử lý file upload
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['product_image']['tmp_name'];
        $fileName = $_FILES['product_image']['name'];
        $fileSize = $_FILES['product_image']['size'];
        $fileType = $_FILES['product_image']['type'];
        $uploadFolder = "../anh/";

        // Tạo đường dẫn lưu file
        $filePath = $uploadFolder . basename($fileName);

        // Kiểm tra và lưu file
        if (move_uploaded_file($fileTmpPath, $filePath)) {
            // Cập nhật bài blog với đường dẫn ảnh mới
            $stmt = $conn->prepare("UPDATE blog SET ten_blog = ?, tac_gia = ?, ngay_dang = ?, noi_dung = ?, anh = ? WHERE id = ?");
            $stmt->bind_param("sssssi", $ten_blog, $tac_gia, $ngay_dang, $noi_dung, $filePath, $id);
        } else {
            echo "Lỗi khi lưu ảnh.";
            exit;
        }
    } else {
        // Nếu không có ảnh mới, chỉ cập nhật thông tin khác
        $stmt = $conn->prepare("UPDATE blog SET ten_blog = ?, tac_gia = ?, ngay_dang = ?, noi_dung = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $ten_blog, $tac_gia, $ngay_dang, $noi_dung, $id);
    }

    // Thực thi truy vấn
    if ($stmt->execute()) {
        echo "<script>alert('Cập nhật thành công!');</script>";
        header("Location: backend_blog.php");
    } else {
        echo "Lỗi: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
