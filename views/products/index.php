<!-- TỆP GIAO DIỆN: views/products/index.php
     PHỤ TRÁCH: Mai Trang (HTML5 Semantic + Khung hiển thị Form & Bảng)
     Thẻ ngữ nghĩa sử dụng: <main>, <header>, <section>, <form>, <table>, <figure>

     [GHI CHÚ BÀN GIAO CHO NHÓM - ĐỂ NỐI LUỒNG MVC]:
     1. Gửi Minh Anh (index.php) & Quỳnh (ProductController.php):
        - Các tham số URL (action) đang sử dụng trong Form & Nút bấm:
          + Thêm mới : index.php?action=store  (method POST)
          + Mở sửa   : index.php?action=edit&id=... (method GET)
          + Lưu sửa  : index.php?action=update (method POST)
          + Xóa      : index.php?action=delete&id=... (method GET)
        - Các biến PHP cần Controller truyền sang View này:
          + $products    : Mảng danh sách toàn bộ sản phẩm (đổ ra bảng).
          + $editProduct : Mảng thông tin 1 sản phẩm đang chọn sửa (đổ lên Form).
        - Các thuộc tính name trong Form khớp với cột CSDL bảng products (schema.sql):
          + id (input hidden khi sửa), name, category, price, image, description.
     2. Gửi Hoàng Phúc (CSS & JS):
        - Các class/id đã đặt sẵn để gắn CSS/JS: .top-wrapper, .main-header,
          .form-section (#productForm), .table-section (#productTable),
          .product-img, .btn-primary, .btn-secondary, .btn-edit, .btn-delete -->

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ Thống Quản Lý Cửa Hàng Sản Phẩm Thời Trang</title>
</head>
<body>

    <!-- Thẻ ngữ nghĩa HTML5: Main -->
    <main class="container">
    
        <!-- KHUNG TRÊN -->
        <table class="top-wrapper" width="90%" align="center" border="0" cellpadding="10" cellspacing="0">
            <tr valign="top">
                
                <!-- CỘT TRÁI -->
                <td width="55%">
                    <header class="main-header">
                        <h1>
                            <strong>
                                HỆ THỐNG<br>
                                QUẢN LÝ CỬA HÀNG<br>
                                SẢN PHẨM THỜI TRANG<br>
                            </strong>
                        </h1>
                        <p>
                            Nền tảng quản trị danh mục quần áo,<br>
                            giày dép và phụ kiện thời trang — hỗ trợ cập nhật giá bán,<br>
                            phân loại kích thước và theo dõi kho hàng nhanh chóng.<br>
                        </p>
                        <figure>
                            <img src="assets/images/fashion.png" alt="Cửa hàng thời trang và phụ kiện" width="90%" height="auto">
                            <figcaption><small>Không gian trưng bày bộ sưu tập thời trang & phụ kiện mới nhất</small></figcaption>
                        </figure>
                    </header>
                </td>

                <!-- CỘT PHẢI -->
                <td width="45%">
                    <section class="form-section" id="product-form-area">
                        <h2><?= isset($editProduct) ? 'Cập Nhật Sản Phẩm' : 'Thêm Sản Phẩm Mới' ?></h2>
                        
                        <!-- Action khớp với ProductController: store() và update() -->
                        <form action="index.php?action=<?= isset($editProduct) ? 'update' : 'store' ?>" method="POST" id="productForm">
                            <?php if (isset($editProduct)): ?>
                                <input type="hidden" name="id" value="<?= $editProduct['id'] ?>">
                            <?php endif; ?>

                            <div class="form-group">
                                <label for="name">Tên sản phẩm (*):</label><br>
                                <input type="text" id="name" name="name" size="35" placeholder="VD: Áo Thun Cotton Basic" 
                                       value="<?= isset($editProduct) ? htmlspecialchars($editProduct['name']) : '' ?>" required>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="category">Danh mục / Size (*):</label><br>
                                <select id="category" name="category" required>
                                    <option value="">-- Chọn danh mục / Size --</option>
                                    <option value="Áo" <?= (isset($editProduct) && $editProduct['category'] == 'Áo') ? 'selected' : '' ?>>Áo (Size S/M/L)</option>
                                    <option value="Quần" <?= (isset($editProduct) && $editProduct['category'] == 'Quần') ? 'selected' : '' ?>>Quần (Size 29-32)</option>
                                    <option value="Váy" <?= (isset($editProduct) && $editProduct['category'] == 'Váy') ? 'selected' : '' ?>>Váy (Size S/M/L)</option>
                                    <option value="Áo khoác" <?= (isset($editProduct) && $editProduct['category'] == 'Áo khoác') ? 'selected' : '' ?>>Áo khoác (Size M/L/XL)</option>
                                    <option value="Giày dép" <?= (isset($editProduct) && $editProduct['category'] == 'Giày dép') ? 'selected' : '' ?>>Giày dép (Size 39-43)</option>
                                    <option value="Phụ kiện" <?= (isset($editProduct) && $editProduct['category'] == 'Phụ kiện') ? 'selected' : '' ?>>Phụ kiện (FreeSize)</option>
                                </select>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="price">Giá bán (VNĐ) (*):</label><br>
                                <input type="number" id="price" name="price" placeholder="VD: 250000" min="1000"
                                       value="<?= isset($editProduct) ? $editProduct['price'] : '' ?>" required>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="image">Hình ảnh sản phẩm (Link / Tên tệp):</label><br>
                                <input type="text" id="image" name="image" size="35" placeholder="VD: assets/images/ao-thun.jpg" 
                                       value="<?= isset($editProduct) && isset($editProduct['image']) ? htmlspecialchars($editProduct['image']) : '' ?>">
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="description">Mô tả chi tiết:</label><br>
                                <textarea id="description" name="description" rows="12" cols="55" placeholder="Chất liệu, màu sắc, kiểu dáng..."><?= isset($editProduct) ? htmlspecialchars($editProduct['description']) : '' ?></textarea>
                            </div>
                            <br>

                            <!-- Cụm nút bấm dùng thẻ <input> chuẩn HTML5 -->
                            <div class="form-actions">
                                <input type="submit" class="btn btn-primary" id="btnSubmit" 
                                       value="<?= isset($editProduct) ? 'Lưu Cập Nhật' : 'Thêm Sản Phẩm' ?>">
                                
                                <?php if (isset($editProduct)): ?>
                                    <input type="button" class="btn btn-secondary" value="Hủy Sửa" 
                                           onclick="window.location.href='index.php'">
                                <?php endif; ?>
                            </div>
                        </form>
                    </section>
                </td>

            </tr>
        </table>

        <hr width="90%">

        <!-- VÙNG 2: BẢNG DANH SÁCH SẢN PHẨM (RỘNG 90% CĂN GIỮA) -->
        <section class="table-section" id="product-list-area">
            <h2 align="center">Danh Sách Sản Phẩm</h2>
            
            <table class="product-table" id="productTable" border="1" cellpadding="8" cellspacing="0" width="90%" align="center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Danh mục / Size</th>
                        <th>Giá bán</th>
                        <th>Mô tả</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Nhận mảng $products từ ProductController::index() -->
                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $item): ?>
                        <tr>
                            <td align="center"><?= $item['id'] ?></td>
                            <td align="center">
                                <?php if (!empty($item['image'])): ?>
                                    <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="product-img" width="60" height="60">
                                <?php else: ?>
                                    <span>Chưa có ảnh</span>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($item['name']) ?></td>
                            <td><?= htmlspecialchars($item['category']) ?></td>
                            <td><?= number_format($item['price'], 0, ',', '.') ?> đ</td>
                            <td><?= htmlspecialchars($item['description']) ?></td>
                            <td class="action-buttons" align="center">
                                <!-- Các nút Sửa / Xóa dùng <input type="button"> khớp với ProductController: edit() và delete() -->
                                <input type="button" class="btn btn-edit" value="Sửa" 
                                       onclick="window.location.href='index.php?action=edit&id=<?= $item['id'] ?>'">
                                <input type="button" class="btn btn-delete" value="Xóa" 
                                       onclick="window.location.href='index.php?action=delete&id=<?= $item['id'] ?>'">
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" align="center">Chưa có dữ liệu sản phẩm.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>

    </main>

</body>
</html>