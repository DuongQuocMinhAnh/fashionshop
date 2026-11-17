<?php

require_once __DIR__ . '/../models/Product.php';

class ProductController {
    private Product $productModel;

    public function __construct() {
        $this->productModel = new Product();
    }

    // Danh sách sản phẩm (Read all)
    public function index(): void {
        $products = $this->productModel->all();
        require_once __DIR__ . '/../views/products/index.php';
    }

    // Form thêm sản phẩm (Create form)
    public function create(): void {
        $errors = [];
        require_once __DIR__ . '/../views/products/create.php';
    }

    // Xử lý lưu sản phẩm mới (Store)
    public function store(): void {
        $errors = $this->validate($_POST);

        if (!empty($errors)) {
            require_once __DIR__ . '/../views/products/create.php';
            return;
        }

        $this->productModel->create([
            'name' => trim($_POST['name']),
            'category' => trim($_POST['category']),
            'price' => (float)$_POST['price'],
            'quantity' => (int)$_POST['quantity'],
            'description' => trim($_POST['description'] ?? '')
        ]);

        $_SESSION['flash_success'] = 'Thêm sản phẩm thành công!';
        header('Location: index.php');
        exit;
    }

    // Form sửa sản phẩm (Edit form)
    public function edit(): void {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $product = $this->productModel->find($id);

        if (!$product) {
            $_SESSION['flash_error'] = 'Không tìm thấy sản phẩm!';
            header('Location: index.php');
            exit;
        }

        $errors = [];
        require_once __DIR__ . '/../views/products/edit.php';
    }

    // Xử lý cập nhật sản phẩm (Update)
    public function update(): void {
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        $product = $this->productModel->find($id);

        if (!$product) {
            $_SESSION['flash_error'] = 'Không tìm thấy sản phẩm!';
            header('Location: index.php');
            exit;
        }

        $errors = $this->validate($_POST);

        if (!empty($errors)) {
            $product = array_merge($product, $_POST);
            require_once __DIR__ . '/../views/products/edit.php';
            return;
        }

        $this->productModel->update($id, [
            'name' => trim($_POST['name']),
            'category' => trim($_POST['category']),
            'price' => (float)$_POST['price'],
            'quantity' => (int)$_POST['quantity'],
            'description' => trim($_POST['description'] ?? '')
        ]);

        $_SESSION['flash_success'] = 'Cập nhật sản phẩm thành công!';
        header('Location: index.php');
        exit;
    }

    // Xử lý xoá sản phẩm (Delete)
    public function delete(): void {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $product = $this->productModel->find($id);

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
        if (!isset($data['quantity']) || !is_numeric($data['quantity']) || (int)$data['quantity'] < 0) {
            $errors['quantity'] = 'Số lượng trong kho phải là số nguyên không âm.';
        }
        return $errors;
    }
}
