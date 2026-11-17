# Fashion Shop - PHP MVC

Dự án website thương mại điện tử thời trang được xây dựng trên nền tảng PHP MVC thuần.

## Cấu trúc thư mục:
- `assets/`: Chứa file tĩnh (css, js, images, thư viện vendor bootstrap, jquery).
- `config/`: Cấu hình kết nối CSDL PDO (`database.php`).
- `controllers/`: Chứa các controller xử lý logic (`Controller.php`, `HomeController.php`).
- `database/`: Chứa các file SQL schema (`schema.sql`).
- `models/`: Chứa các class tương tác dữ liệu/Database (`Model.php`).
- `views/`: Chứa giao diện hiển thị (`layout/header.php`, `layout/footer.php`, `home.php`, `not_found.php`).
- `helpers.php`: Chứa các hàm tiện ích dùng chung (xss escape, format tiền, url helper...).
- `index.php`: Front Controller điều hướng request.
