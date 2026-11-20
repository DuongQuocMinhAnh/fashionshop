/**
 * FASHION SHOP - JAVASCRIPT
 * Phụ trách: Hoàng Phúc
 * Tính năng: Kiểm tra form client-side, xác nhận xóa, mượt mà khi thao tác
 */

document.addEventListener('DOMContentLoaded', () => {
    const productForm = document.getElementById('productForm');

    if (productForm) {
        productForm.addEventListener('submit', (e) => {
            const nameInput = document.getElementById('name');
            const categoryInput = document.getElementById('category');
            const priceInput = document.getElementById('price');

            // Kiểm tra tên sản phẩm
            if (!nameInput.value.trim()) {
                alert('Vui lòng nhập tên sản phẩm!');
                nameInput.focus();
                e.preventDefault();
                return;
            }

            // Kiểm tra danh mục
            if (!categoryInput.value) {
                alert('Vui lòng chọn danh mục cho sản phẩm!');
                categoryInput.focus();
                e.preventDefault();
                return;
            }

            // Kiểm tra giá sản phẩm > 0
            const price = parseFloat(priceInput.value);
            if (isNaN(price) || price <= 0) {
                alert('Giá bán phải là số dương lớn hơn 0!');
                priceInput.focus();
                e.preventDefault();
                return;
            }
        });
    }

    // Tự động cuộn mượt lên form nếu đang ở chế độ sửa sản phẩm
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('action') === 'edit') {
        const formArea = document.getElementById('product-form-area');
        if (formArea) {
            formArea.scrollIntoView({ behavior: 'smooth' });
        }
    }
});
