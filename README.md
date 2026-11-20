# HỆ THỐNG QUẢN LÝ CỬA HÀNG SẢN PHẨM THỜI TRANG (FASHION SHOP)
> **Báo Cáo Đồ Án Giữa Kỳ - Nhóm Lập Trình Web PHP MVC**

---

## 1. Giới thiệu dự án
Dự án được xây dựng theo kiến trúc **MVC (Model - View - Controller)** thuần bằng ngôn ngữ PHP, kết nối cơ sở dữ liệu MySQL qua PDO. Hệ thống hỗ trợ quản lý các sản phẩm thời trang (quần áo, giày dép, phụ kiện...) với đầy đủ các thao tác cơ bản **CRUD (Thêm - Xem - Sửa - Xóa)** kèm hiển thị hình ảnh sản phẩm trực quan.

Mục tiêu cốt lõi: Thiết kế đơn giản, phân chia vai trò rõ ràng, dễ vận hành và phục vụ demo báo cáo trực tiếp trên localhost (XAMPP).

---

## 2. Phân công nhiệm vụ thành viên theo đợt triển khai

| Đợt | Ưu tiên | Thành viên phụ trách | Thư mục / File phụ trách | Chi tiết công việc lập trình | Điều kiện kích hoạt & Bàn giao (Dependencies) |
| :--- | :--- | :--- | :--- | :--- | :--- |
| **ĐỢT 1**<br>Nền móng & Giao diện thô | **Ưu tiên 1**<br>*(Làm đầu tiên)* | **1. Bảo Như** | `database/`<br>`config/database.php` | • Thiết kế CSDL và tạo bảng `products` (`id`, `name`, `category`, `price`, `image`, `description`) kèm dữ liệu mẫu.<br>• Viết file cấu hình kết nối PDO MySQL (`ERRMODE_EXCEPTION`, `utf8mb4`). | Bắt đầu ngay từ phút đầu ➔ Bàn giao file kết nối PDO và cấu trúc bảng cho Duyên viết Model. |
| **ĐỢT 1**<br>Nền móng & Giao diện thô | **Ưu tiên 1**<br>*(Làm song song)* | **2. Mai Trang** | `views/index.php` | • Dựng sẵn khung cấu trúc HTML5 chuẩn ngữ nghĩa (`<main>`, `<header>`, `<section>`, `<form>`, `<table>`, `<figure>`).<br>• Xây dựng Form thêm/sửa sản phẩm thời trang và Bảng danh sách hiển thị sản phẩm kèm nút thao tác. | Bắt đầu cùng lúc với Bảo Như ➔ Bàn giao khung HTML (thẻ, class, id) cho Hoàng Phúc gắn CSS/JS. |
| **ĐỢT 2**<br>Xử lý dữ liệu & Làm đẹp | **Ưu tiên 2**<br>*(Nối tiếp Đợt 1)* | **3. Duyên** | `models/Product.php` | • Nhận file kết nối PDO từ Bảo Như.<br>• Viết 5 hàm CRUD chuẩn Prepared Statements chống SQL Injection: `getAll()`, `getById($id)`, `insert()`, `update()`, `delete($id)`. | Kích hoạt sau khi Bảo Như xong CSDL & PDO ➔ Bàn giao 5 hàm CRUD cho Quỳnh gọi trong Controller. |
| **ĐỢT 2**<br>Xử lý dữ liệu & Làm đẹp | **Ưu tiên 2**<br>*(Nối tiếp Đợt 1)* | **4. Hoàng Phúc** | `assets/css/style.css`<br>`assets/js/main.js` | • Căn chỉnh bố cục Flexbox 2 cột, tối ưu thẩm mỹ hiển thị hình ảnh, hiệu ứng `:hover` cho nút bấm.<br>• Viết JS bắt lỗi Form rỗng, giá <= 0 và hỗ trợ cuộn mượt khi chỉnh sửa. | Kích hoạt sau khi Mai Trang dựng xong HTML ➔ Bàn giao giao diện hoàn chỉnh và kịch bản tương tác cho View. |
| **ĐỢT 3**<br>Cầu nối trung tâm | **Ưu tiên 3**<br>*(Nối luồng MVC)* | **5. Quỳnh, Bảo Như** | `controllers/ProductController.php` | • Tiếp nhận dữ liệu đầu vào từ View (`$_POST`, `$_GET`).<br>• Gọi các hàm xử lý dữ liệu tương ứng từ Model và trả kết quả hiển thị lại cho View.<br>• Xử lý luồng nghiệp vụ: `index`, `store`, `edit`, `update`, `delete`. | Kích hoạt sau khi Duyên xong Model VÀ Mai Trang xong View ➔ Bàn giao luồng Controller cho Minh Anh điều hướng. |
| **ĐỢT 4**<br>Chốt hạ & Kiểm thử tổng | **Ưu tiên 4**<br>*(Hoàn tất dự án)* | **6. Minh Anh**<br>*(Tech Lead)* | `index.php`<br>& Git Repository | • Chốt quy ước đặt tên biến, cột CSDL cho cả nhóm từ đầu.<br>• Viết cổng điều hướng trung tâm `index.php` phân phối request theo tham số `$_GET['action']`.<br>• Ghép nhánh Git (Review & Merge code) và chạy test luồng CRUD tổng thể trên XAMPP. | Kích hoạt sau khi cả 5 thành viên hoàn thành và đẩy code lên nhánh Git ➔ Nghiệm thu và đóng gói sản phẩm hoàn thiện. |

---

## 3. Cấu trúc thư mục dự án

```text
fashionshop/
├── assets/
│   ├── css/
│   │   └── style.css            # CSS định dạng giao diện, bố cục Flexbox (Hoàng Phúc)
│   ├── js/
│   │   └── main.js              # JavaScript kiểm tra form, tương tác client (Hoàng Phúc)
│   └── images/                  # Thư mục chứa hình ảnh sản phẩm mẫu & banner
│       ├── fashion.png          # Banner / Logo mặc định của cửa hàng
│       ├── ao-thun.jpg          # Ảnh mẫu: Áo thun unisex cotton
│       ├── quan-jean.jpg        # Ảnh mẫu: Quần jean slimfit nam
│       ├── vay-xoe.jpg          # Ảnh mẫu: Váy xòe công sở nữ
│       └── ao-khoac.jpg         # Ảnh mẫu: Áo khoác bomber kaki
├── config/
│   └── database.php             # Cấu hình kết nối PDO MySQL (Bảo Như)
├── controllers/
│   └── ProductController.php    # Điều phối luồng xử lý nghiệp vụ CRUD (Quỳnh, Bảo Như)
├── database/
│   └── schema.sql               # Script tạo Database, bảng products và dữ liệu mẫu (Bảo Như)
├── models/
│   └── Product.php              # Xử lý truy vấn CSDL bằng Prepared Statements (Duyên)
├── views/
│   └── index.php                # Giao diện hiển thị HTML5, Form & Bảng dữ liệu (Mai Trang)
├── index.php                    # Front Controller điều hướng request theo action (Minh Anh)
└── README.md                    # Tài liệu đặc tả và hướng dẫn triển khai dự án
```

---

## 4. Hướng dẫn cài đặt và chạy thử trên XAMPP

1. **Khởi động dịch vụ:**
   - Mở ứng dụng **XAMPP Control Panel**.
   - Bấm **Start** cả hai module: **Apache** và **MySQL**.

2. **Cài đặt Cơ sở dữ liệu:**
   - Truy cập giao diện quản trị: `http://localhost/phpmyadmin/`.
   - Chọn thẻ **Import** (Nhập).
   - Chọn tệp `database/schema.sql` trong thư mục dự án và nhấn **Import**.
   - CSDL `fashionshop` và bảng `products` sẽ được tạo kèm 4 sản phẩm mẫu có sẵn hình ảnh.

3. **Truy cập ứng dụng:**
   - Đặt thư mục dự án vào `C:/xampp/htdocs/fashionshop`.
   - Mở trình duyệt web và truy cập: `http://localhost/fashionshop`.
