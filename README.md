# Fashion Shop (Clean Architecture)

Thiết kế website thương mại điện tử chuyên sâu về mảng thời trang, xử lý thuộc tính sản phẩm phức tạp.

## Cấu trúc dự án
Cấu trúc dự án theo mô hình Clean Architecture / Layered Architecture:

- **config/**: Lưu cấu hình hệ thống (kết nối database config.php).
- **database/**: Chứa các script SQL (schema.sql, seed.sql).
- **public/**: Document root của Web server (chứa index.php, css/, js/, images/).
- **src/**: Mã nguồn ứng dụng:
  - **Domain/**: Thực thể (Entity) và Giao diện (Repository Interface).
  - **Application/**: Các ca sử dụng nghiệp vụ (Use Cases).
  - **Infrastructure/**: Tầng hạ tầng kỹ thuật (Kết nối Database, Session storage, MySQL Repository).
  - **Presentation/**: Tầng hiển thị (Controller, View template, Helpers).
