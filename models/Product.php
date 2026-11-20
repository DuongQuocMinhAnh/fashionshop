<?php
/**
 * Lớp Product - Xử lý thao tác dữ liệu (CRUD) bảng products
 * Sử dụng PDO Prepared Statements chống SQL Injection với dữ liệu dạng mảng.
 */
class Product {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    /**
     * 1. Lấy tất cả danh sách sản phẩm
     */
    public function getAll() {
        $sql = "SELECT * FROM products";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * 2. Lấy thông tin một sản phẩm theo ID
     */
    public function getById($id) {
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * 3. Thêm mới sản phẩm (Nhận vào mảng dữ liệu từ Controller)
     */
    public function insert($data) {
        $sql = "INSERT INTO products (name, category, price, image, description) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['name'] ?? '',
            $data['category'] ?? '',
            $data['price'] ?? 0,
            !empty($data['image']) ? $data['image'] : 'assets/images/fashion.png',
            $data['description'] ?? ''
        ]);
    }

    /**
     * 4. Cập nhật thông tin sản phẩm theo ID (Nhận vào ID và mảng dữ liệu)
     */
    public function update($id, $data) {
        $sql = "UPDATE products SET name = ?, category = ?, price = ?, image = ?, description = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            $data['name'] ?? '',
            $data['category'] ?? '',
            $data['price'] ?? 0,
            !empty($data['image']) ? $data['image'] : 'assets/images/fashion.png',
            $data['description'] ?? '',
            $id
        ]);
    }

    /**
     * 5. Xóa sản phẩm theo ID
     */
    public function delete($id) {
        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>