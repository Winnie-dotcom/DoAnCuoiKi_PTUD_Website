function addToCart(productId) {
    const quantity = document.getElementById('quantity-input').value;
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = 'them_vao_gio_hang/them_vao_gio_hang.php';

    const idSanPhamInput = document.createElement('input');
    idSanPhamInput.type = 'hidden';
    idSanPhamInput.name = 'id_san_pham';
    idSanPhamInput.value = productId;
    form.appendChild(idSanPhamInput);

    const soLuongInput = document.createElement('input');
    soLuongInput.type = 'hidden';
    soLuongInput.name = 'so_luong';
    soLuongInput.value = quantity;
    form.appendChild(soLuongInput);

    document.body.appendChild(form);
    form.submit();
}
