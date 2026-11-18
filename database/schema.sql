-- Tạo cơ sở dữ liệu nếu dùng MySQL (khi bật MySQL trong XAMPP Control Panel)
CREATE DATABASE IF NOT EXISTS `fashionshop` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `fashionshop`;

CREATE TABLE IF NOT EXISTS `products` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `category` VARCHAR(100) NOT NULL,
    `price` DECIMAL(12, 2) NOT NULL DEFAULT 0.00,
    'image' VARCHAR(255) NULL
    `quantity` INT NOT NULL DEFAULT 0,
    `description` TEXT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



INSERT INTO 'products'
('name', 'category', 'price', 'image', 'quantity', 'description')
VALUES
(
    'Áo Thun Unisex Cotton',
    'Áo',
    180000,
    'assets/images/ao-thun.jpg',
    50,
    'Chất liệu cotton 100% thoáng mát, phong cách trẻ trung'
),
(
    'Quần Jean Slimfit Nam',
    'Quần',
    350000,
    'assets/images/quan-jean.jpg',
    30,
    'Vải denim co giãn nhẹ, kiểu dáng hiện đại'
),
(
    'Váy Xòe Công Sở Nữ',
    'Váy',
    420000,
    'assets/images/vay-xoe.jpg',
    20,
    'Thiết kế thanh lịch, phù hợp môi trường công sở'
),
(
    'Áo Khoác Bomber Kaki',
    'Áo khoác',
    490000,
    'assets/images/ao-khoac.jpg',
    15,
    'Chất vải kaki 2 lớp, phong cách năng động'
);