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

class ProductController
{
    private Product $productModel;

    public function __construct()
    {
        // Khởi tạo kết nối CSDL và Model
        $db = Database::getConnection();
        $this->productModel = new Product($db);
    }

    // 1. Hiển thị danh sách sản phẩm
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Lấy danh sách sản phẩm từ Model
        $products = $this->productModel->getAll();

        // Nạp file giao diện View để hiển thị
        require_once __DIR__ . '/../views/index.php';
    }

    // 2. Thêm mới sản phẩm
    public function store()
    {
        // Kiểm tra session
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Chỉ xử lý khi người dùng gửi dữ liệu từ Form (POST)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Lấy và làm sạch dữ liệu từ form
            $name = trim($_POST['name'] ?? '');
            $category = trim($_POST['category'] ?? '');
            $price = isset($_POST['price']) ? (float)$_POST['price'] : 0;
            $image = trim($_POST['image'] ?? '');
            $description = trim($_POST['description'] ?? '');

            // Kiểm tra các trường bắt buộc (Tên, danh mục không được trống và giá > 0)
            if (!empty($name) && !empty($category) && $price > 0) {

                // Đóng gói dữ liệu để gửi sang Model
                $data = [
                    'name' => $name,
                    'category' => $category,
                    'price' => $price,
                    'image' => $image,
                    'description' => $description
                ];

                // Gọi Model để thêm vào CSDL
                $result = $this->productModel->insert($data);

                if ($result) {
                    $_SESSION['flash_success'] = "Thêm sản phẩm mới thành công!";
                } else {
                    $_SESSION['flash_error'] = "Không thể thêm sản phẩm, vui lòng thử lại!";
                }
            } else {
                $_SESSION['flash_error'] = "Vui lòng điền đầy đủ tên, danh mục và giá hợp lệ!";
            }
        }

        // Chuyển hướng quay về trang chính
        header('Location: index.php');
        exit;
    }

    // 3. Lấy thông tin sản phẩm cần sửa
    public function edit()
    {
        // Khởi động session nếu chưa mở
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Lấy ID từ URL và ép về kiểu int
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        // Kiểm tra nếu ID hợp lệ
        if ($id > 0) {
            // Tìm sản phẩm theo ID
            $editProduct = $this->productModel->getById($id);

            // Nếu tìm thấy sản phẩm
            if ($editProduct) {
                // Lấy toàn bộ danh sách sản phẩm để bảng phía dưới vẫn hiển thị đầy đủ
                $products = $this->productModel->getAll();

                // Nạp file View (View sẽ tự động điền dữ liệu của $editProduct lên Form)
                require_once __DIR__ . '/../views/index.php';
                return;
            } else {
                $_SESSION['flash_error'] = "Không tìm thấy sản phẩm cần sửa!";
            }
        } else {
            $_SESSION['flash_error'] = "ID sản phẩm không hợp lệ!";
        }

        // Nếu có lỗi (ID sai hoặc không thấy sản phẩm), chuyển về trang chính
        header('Location: index.php');
        exit;
    }

    // 4. Cập nhật thông tin sản phẩm
    public function update()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy ID và các thông tin từ Form gửi lên
            $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
            $name = trim($_POST['name'] ?? '');
            $category = trim($_POST['category'] ?? '');
            $price = isset($_POST['price']) ? (float)$_POST['price'] : 0;
            $image = trim($_POST['image'] ?? '');
            $description = trim($_POST['description'] ?? '');

            if ($id > 0 && !empty($name) && !empty($category) && $price > 0) {

                // Kiểm tra xem sản phẩm có trong database không
                $product = $this->productModel->getById($id);
                if ($product) // Nếu có sản phẩm
                {
                    $data = [
                        'name' => $name,
                        'category' => $category,
                        'price' => $price,
                        'image' => $image,
                        'description' => $description
                    ];
                    // Gọi Model cập nhật dữ liệu
                    $result = $this->productModel->update($id, $data);

                    if ($result) { // Nếu cập nhật thành công
                        $_SESSION['flash_success'] = "Cập nhật sản phẩm thành công!";
                    } else { // Nếu cập nhật thất bại
                        $_SESSION['flash_error'] = "Không thể cập nhật sản phẩm, vui lòng thử lại sau!";
                    }
                } else { // Nếu không tìm thấy sản phẩm
                    $_SESSION['flash_error'] = "Không tìm thấy sản phẩm cần cập nhật!";
                }
            } else {
                $_SESSION['flash_error'] = "Vui lòng điền đầy đủ thông tin hợp lệ!";
            }
        }
        header('Location: index.php');
        exit;
    }

    // 5. Xóa sản phẩm
    public function delete()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0; // lấy id, ép về kiểu int

        //kiểm tra logic
        if ($id > 0) {
            $product = $this->productModel->getById($id);

            if ($product) { // nếu có sản phẩm
                $result = $this->productModel->delete($id);

                if ($result) { // nếu xóa thành công
                    $_SESSION['flash_success'] = "Đã xóa sản phẩm thành công!";
                }
                // nếu xóa thất bại
                else {
                    $_SESSION['flash_error'] = "Không thể xóa sản phẩm, vui lòng thử lại sau!";
                }
            }
            // nếu không tìm thấy sản phẩm
            else {
                $_SESSION['flash_error'] = "Không tìm thấy sản phẩm!";
            }
        } else {
            $_SESSION['flash_error'] = "ID không hợp lệ!";
        }

        header('Location: index.php');
        exit;
    }
}
