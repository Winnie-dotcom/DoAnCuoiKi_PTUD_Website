function payment(productId) {
    // Tự động gán số lượng là 1
    const quantity = 1;

    // Tạo form để gửi dữ liệu
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = 'chon_mua/chon_mua.php';

    // Tạo input ẩn cho ID sản phẩm
    const idSanPhamInput = document.createElement('input');
    idSanPhamInput.type = 'hidden';
    idSanPhamInput.name = 'id_san_pham';
    idSanPhamInput.value = productId;
    form.appendChild(idSanPhamInput);

    // Tạo input ẩn cho số lượng sản phẩm
    const soLuongInput = document.createElement('input');
    soLuongInput.type = 'hidden';
    soLuongInput.name = 'so_luong';
    soLuongInput.value = quantity; // Gán số lượng là 1
    form.appendChild(soLuongInput);

    // Thêm form vào body và submit
    document.body.appendChild(form);
    form.submit();
}
