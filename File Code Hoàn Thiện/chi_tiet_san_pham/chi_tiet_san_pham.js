document.addEventListener("DOMContentLoaded", () => {
  const quantityInput = document.getElementById("quantity-input");
  const decreaseBtn = document.getElementById("decrease-btn");
  const increaseBtn = document.getElementById("increase-btn");

  // Giảm số lượng
  decreaseBtn.addEventListener("click", () => {
    let currentValue = parseInt(quantityInput.value) || 1; // Nếu giá trị rỗng, mặc định là 1
    if (currentValue > parseInt(quantityInput.min)) {
      quantityInput.value = currentValue - 1;
    }
  });

  // Tăng số lượng
  increaseBtn.addEventListener("click", () => {
    let currentValue = parseInt(quantityInput.value) || 1;
    if (currentValue < parseInt(quantityInput.max)) {
      quantityInput.value = currentValue + 1;
    }
  });
});
