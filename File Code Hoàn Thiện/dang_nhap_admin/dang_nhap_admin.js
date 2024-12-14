// JS cho nút ẩn/ hiện mật khẩu
const passwordField = document.getElementById('password');
const togglePassword = document.getElementById('togglePassword');
const hidePasswordIcon = document.querySelector('.hide-password');
const showPasswordIcon = document.querySelector('.show-password');

hidePasswordIcon.style.display = 'block';
showPasswordIcon.style.display = 'none';  

togglePassword.addEventListener('click', function () {
// Đổi loại input giữa 'password' và 'text'
const isPassword = passwordField.type === 'password';
passwordField.type = isPassword ? 'text' : 'password';

// Hiển thị ảnh tương ứng
if (isPassword) {
    hidePasswordIcon.style.display = 'none';
    showPasswordIcon.style.display = 'block';
    } 
else {
    hidePasswordIcon.style.display = 'block';
    showPasswordIcon.style.display = 'none';
}
  });