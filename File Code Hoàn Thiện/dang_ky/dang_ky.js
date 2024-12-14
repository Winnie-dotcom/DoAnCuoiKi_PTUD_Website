// JS cho nút ẩn/hiện mật khẩu
document.addEventListener('DOMContentLoaded', function () {
    const passwordField = document.getElementById('password');
    const confirmPasswordField = document.getElementById('confirm_password');
    
    const togglePassword = document.getElementById('togglePassword');
    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    
    const hidePasswordIcon = document.querySelector('.hide-password');
    const showPasswordIcon = document.querySelector('.show-password');
    
    const hideConfirmPasswordIcon = document.querySelectorAll('.hide-password')[1];
    const showConfirmPasswordIcon = document.querySelectorAll('.show-password')[1];
  
    // Ẩn mật khẩu khi bắt đầu
    hidePasswordIcon.style.display = 'block';
    showPasswordIcon.style.display = 'none';  
    hideConfirmPasswordIcon.style.display = 'block';
    showConfirmPasswordIcon.style.display = 'none';
  
    // Đổi loại input giữa 'password' và 'text' cho mật khẩu
    togglePassword.addEventListener('click', function () {
      const isPassword = passwordField.type === 'password';
      passwordField.type = isPassword ? 'text' : 'password';
  
      if (isPassword) {
        hidePasswordIcon.style.display = 'none';
        showPasswordIcon.style.display = 'block';
      } else {
        hidePasswordIcon.style.display = 'block';
        showPasswordIcon.style.display = 'none';
      }
    });
  
    // Đổi loại input giữa 'password' và 'text' cho xác nhận mật khẩu
    toggleConfirmPassword.addEventListener('click', function () {
      const isConfirmPassword = confirmPasswordField.type === 'password';
      confirmPasswordField.type = isConfirmPassword ? 'text' : 'password';
  
      if (isConfirmPassword) {
        hideConfirmPasswordIcon.style.display = 'none';
        showConfirmPasswordIcon.style.display = 'block';
      } else {
        hideConfirmPasswordIcon.style.display = 'block';
        showConfirmPasswordIcon.style.display = 'none';
      }
    });
  });
  