<?php
// Lấy danh sách sản phẩm Best Seller
$sql_best_seller = "
    SELECT 
        ctdh.id_san_pham, 
        sp.ten_san_pham, 
        sp.anh_minh_hoa, 
        sp.gia_ban, 
        SUM(ctdh.so_luong) AS tong_so_luong
    FROM 
        chi_tiet_don_hang AS ctdh
    JOIN 
        san_pham AS sp 
    ON 
        ctdh.id_san_pham = sp.id
    GROUP BY 
        ctdh.id_san_pham
    ORDER BY 
        tong_so_luong DESC
    LIMIT 5;
";

$result_best_seller = $conn->query($sql_best_seller);

// Kiểm tra kết quả
$bestsellers = [];
if ($result_best_seller->num_rows > 0) {
    while ($row = $result_best_seller->fetch_assoc()) {
        $bestsellers[] = $row;
    }
}

function shortenText($text, $maxLength = 20) {
    if (mb_strlen($text) > $maxLength) {
        return mb_substr($text, 0, $maxLength - 3) . '...';
    }
    return $text;
}


?>