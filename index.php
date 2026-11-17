<?php
/**
 * FRONT CONTROLLER - Điểm bắt đầu xử lý mọi request.
 */
session_start();

require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/controllers/HomeController.php';

try {
    $page = $_GET['page'] ?? 'home';

    switch ($page) {
        case 'home':
            (new HomeController())->index();
            break;
        default:
            http_response_code(404);
            $dir = __DIR__ . '/views/';
            include $dir . 'layout/header.php';
            include $dir . 'not_found.php';
            include $dir . 'layout/footer.php';
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo '<h1>Lỗi kết nối cơ sở dữ liệu</h1>';
    echo '<p>Vui lòng cấu hình lại thông số CSDL trong <code>config/database.php</code>.</p>';
    echo '<pre>' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</pre>';
} catch (Throwable $e) {
    http_response_code(500);
    echo '<h1>Đã xảy ra lỗi</h1>';
    echo '<pre>' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</pre>';
}
