<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Product.php';

class ProductController {
    private Product $productModel;

    public function __construct() {
        $db = Database::getConnection(); // Lấy đối tượng PDO
        $this->productModel = new Product($db); // Truyền $db vào constructor
    }

    // Danh sách sản phẩm (Read all)
    public function index(): void {
        $products = $this->productModel->getAll();
        require_once __DIR__ . '/../views/index.php';
    }

    // Form thêm sản phẩm (Create form)
    public function create(): void {
        $errors = [];
        require_once __DIR__ . '/../views/index.php';
    }

    // Xử lý lưu sản phẩm mới (Store)
    public function store(): void {
        $errors = $this->validate($_POST);

        if (!empty($errors)) {
            require_once __DIR__ . '/../views/index.php';
            return;
        }

        $this->productModel->insert([
            'name' => trim($_POST['name']),
            'category' => trim($_POST['category']),
            'price' => (float)$_POST['price'],
            'description' => trim($_POST['description'] ?? '')
        ]);

        $_SESSION['flash_success'] = 'Thêm sản phẩm thành công!';
        header('Location: index.php');
        exit;
    }

    // Form sửa sản phẩm (Edit form)
    public function edit(): void {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $product = $this->productModel->getById($id);

        if (!$product) {
            $_SESSION['flash_error'] = 'Không tìm thấy sản phẩm!';
            header('Location: index.php');
            exit;
        }

        $errors = [];
        require_once __DIR__ . '/../views/index.php';
    }

    // Xử lý cập nhật sản phẩm (Update)
    public function update(): void {
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        $product = $this->productModel->getById($id);

        if (!$product) {
            $_SESSION['flash_error'] = 'Không tìm thấy sản phẩm!';
            header('Location: index.php');
            exit;
        }

        $errors = $this->validate($_POST);

        if (!empty($errors)) {
            $product = array_merge($product, $_POST);
            require_once __DIR__ . '/../views/index.php';
            return;
        }

        $this->productModel->update($id, [
            'name' => trim($_POST['name']),
            'category' => trim($_POST['category']),
            'price' => (float)$_POST['price'],
            'description' => trim($_POST['description'] ?? '')
        ]);

        $_SESSION['flash_success'] = 'Cập nhật sản phẩm thành công!';
        header('Location: index.php');
        exit;
    }

    // Xử lý xoá sản phẩm (Delete)
    public function delete(): void {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $product = $this->productModel->getById($id);

        if ($product) {
            $this->productModel->delete($id);
            $_SESSION['flash_success'] = 'Đã xoá sản phẩm thành công!';
        } else {
            $_SESSION['flash_error'] = 'Sản phẩm không tồn tại!';
        }

        header('Location: index.php');
        exit;
    }

    private function validate(array $data): array {
        $errors = [];
        if (empty(trim($data['name'] ?? ''))) {
            $errors['name'] = 'Tên sản phẩm không được để trống.';
        }
        if (empty(trim($data['category'] ?? ''))) {
            $errors['category'] = 'Vui lòng nhập hoặc chọn loại sản phẩm.';
        }
        if (!isset($data['price']) || !is_numeric($data['price']) || (float)$data['price'] < 0) {
            $errors['price'] = 'Giá phải là số dương lớn hơn hoặc bằng 0.';
        }
        return $errors;
    }
}
