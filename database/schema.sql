-- Tạo cơ sở dữ liệu nếu dùng MySQL (khi bật MySQL trong XAMPP Control Panel)
CREATE DATABASE IF NOT EXISTS `fashionshop` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `fashionshop`;

CREATE TABLE IF NOT EXISTS `products` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `category` VARCHAR(100) NOT NULL,
    `price` DECIMAL(12, 2) NOT NULL DEFAULT 0.00,
    `quantity` INT NOT NULL DEFAULT 0,
    `description` TEXT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dữ liệu mẫu ban đầu
INSERT INTO `products` (`name`, `category`, `price`, `quantity`, `description`) VALUES
('Áo Thun Unisex Cotton', 'Áo', 180000, 50, 'Chất liệu cotton 100% thoáng mát, co giãn 4 chiều'),
('Quần Jean Slimfit Nam', 'Quần', 350000, 30, 'Vải denim co giãn nhẹ, giữ form dáng chuẩn'),
('Váy Xòe Công Sở Nữ', 'Váy', 420000, 20, 'Thiết kế thanh lịch, phù hợp mặc đi làm hoặc dự tiệc'),
('Áo Khoác Bomber Kaki', 'Áo khoác', 490000, 15, 'Phong cách trẻ trung, chất vải kaki 2 lớp chống gió tốt');
