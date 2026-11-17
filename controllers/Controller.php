<?php
/**
 * Base Controller: Cung cấp hàm render view, redirect và kiểm tra HTTP method.
 */
class Controller
{
    /**
     * Render view lồng vào layout header/footer chung.
     */
    protected function render(string $view, array $data = [], int $status = 200): void
    {
        http_response_code($status);
        $data['flash'] = $_SESSION['flash'] ?? null;
        unset($_SESSION['flash']);

        $dir = __DIR__ . '/../views/';
        extract($data, EXTR_SKIP);
        include $dir . 'layout/header.php';
        include $dir . $view . '.php';
        include $dir . 'layout/footer.php';
    }

    /**
     * Chuyển hướng trang.
     */
    protected function redirect(string $location): void
    {
        header('Location: ' . $location);
        exit;
    }

    /**
     * Kiểm tra request method POST.
     */
    protected function isPost(): bool
    {
        return ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST';
    }
}
