<?php
/**
 * Các hàm tiện ích dùng chung trong toàn bộ ứng dụng.
 */

/**
 * Chống XSS: Luôn escape dữ liệu trước khi hiển thị ra View.
 */
function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

/**
 * Định dạng tiền tệ VND (VD: 100000 -> 100.000 ₫).
 */
function money(int $amount): string
{
    return number_format($amount, 0, ',', '.') . ' ₫';
}

/**
 * Tạo URL tương đối theo controller/action hoặc page param.
 * VD: url('home') -> index.php?page=home
 */
function url(string $page, array $params = []): string
{
    return 'index.php?' . http_build_query(array_merge(['page' => $page], $params));
}
