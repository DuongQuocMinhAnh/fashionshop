-- 1. Tạo cơ sở dữ liệu nếu chưa có
CREATE DATABASE IF NOT EXISTS `fashionshop` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `fashionshop`;

-- 2. Tạo bảng products (Đã có cột image)
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `category` VARCHAR(100) NOT NULL,
    `price` DECIMAL(12, 2) NOT NULL DEFAULT 0,
    `image` VARCHAR(255) NULL,
    `description` TEXT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `products` (`name`, `category`, `price`, `image`, `description`) VALUES
('Áo Thun Unisex Cotton', 'Áo', 180000.00, 'assets/images/ao-thun.jpg', 'Chất liệu cotton 100% thoáng mát, phong cách trẻ trung.'),
('Quần Jean Slimfit Nam', 'Quần', 350000.00, 'assets/images/quan-jean.jpg', 'Vải denim co giãn nhẹ, kiểu dáng hiện đại.'),
('Váy Xòe Công Sở Nữ', 'Váy', 420000.00, 'assets/images/vay-xoe.jpg', 'Thiết kế thanh lịch, phù hợp môi trường công sở.'),
('Áo Khoác Bomber Kaki', 'Áo khoác', 490000.00, 'assets/images/ao-khoac.jpg', 'Chất vải kaki 2 lớp, phong cách năng động.');