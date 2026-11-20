<?php
/**
 * CỔNG ĐIỀU HƯỚNG TRUNG TÂM (ROUTER)
 * PHỤ TRÁCH: Minh Anh (Tech Lead)
 * CHI TIẾT CÔNG VIỆC:
 * - Tiếp nhận request từ người dùng qua tham số $_GET['action'].
 * - Điều hướng và gọi hàm tương ứng trong ProductController.
 */

require_once __DIR__ . '/controllers/ProductController.php';

// Khởi tạo Controller
$controller = new ProductController();

// Lấy action từ URL (mặc định là 'index')
$action = $_GET['action'] ?? 'index';

// Điều hướng request theo $action (Viết switch-case ở đây)

