<?php
/**
 * CONTROLLER: ProductController.php
 * PHỤ TRÁCH: Quỳnh, Bảo Như
 * CHI TIẾT CÔNG VIỆC:
 * - Tiếp nhận dữ liệu đầu vào từ View ($_POST, $_GET).
 * - Gọi các hàm xử lý dữ liệu tương ứng từ Model và trả kết quả hiển thị lại cho View.
 * - Xử lý luồng nghiệp vụ: index, store, edit, update, delete.
 */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Product.php';

class ProductController {
    private Product $productModel;

    public function __construct() {
        // Khởi tạo kết nối CSDL và Model
        $db = Database::getConnection();
        $this->productModel = new Product($db);
    }

    // 1. Hiển thị danh sách sản phẩm
    public function index() {
        // Viết code xử lý ở đây
    }

    // 2. Thêm mới sản phẩm
    public function store() {
        // Viết code xử lý ở đây
    }

    // 3. Lấy thông tin sản phẩm cần sửa
    public function edit() {
        // Viết code xử lý ở đây
    }

    // 4. Cập nhật thông tin sản phẩm
    public function update() {
        // Viết code xử lý ở đây
    }

    // 5. Xóa sản phẩm
    public function delete() {
        // Viết code xử lý ở đây
    }
}
