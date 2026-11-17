-- Schema database rỗng cho dự án mới
-- CREATE DATABASE IF NOT EXISTS `my_database` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
-- USE `my_database`;

CREATE DATABASE mvc_demo;
USE mvc_demo;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    description TEXT
);

