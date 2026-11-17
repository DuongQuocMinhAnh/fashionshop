<?php

require_once __DIR__ . '/../config/database.php';

class Product {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function all(): array {
        $stmt = $this->db->query("SELECT * FROM products ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $product = $stmt->fetch();
        return $product ?: null;
    }

    public function create(array $data): bool {
        $stmt = $this->db->prepare("
            INSERT INTO products (name, category, price, quantity, description)
            VALUES (:name, :category, :price, :quantity, :description)
        ");
        return $stmt->execute([
            'name' => $data['name'],
            'category' => $data['category'],
            'price' => $data['price'],
            'quantity' => $data['quantity'],
            'description' => $data['description'] ?? ''
        ]);
    }

    public function update(int $id, array $data): bool {
        $stmt = $this->db->prepare("
            UPDATE products 
            SET name = :name, category = :category, price = :price, quantity = :quantity, description = :description, updated_at = CURRENT_TIMESTAMP
            WHERE id = :id
        ");
        return $stmt->execute([
            'id' => $id,
            'name' => $data['name'],
            'category' => $data['category'],
            'price' => $data['price'],
            'quantity' => $data['quantity'],
            'description' => $data['description'] ?? ''
        ]);
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
