<!-- TỆP GIAO DIỆN: views/index.php
     PHỤ TRÁCH: Mai Trang (HTML5 Semantic) & Hoàng Phúc (Giao diện)
     Nối luồng MVC: Quỳnh, Bảo Như (Controller) & Duyên (Model)
-->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ Thống Quản Lý Cửa Hàng Sản Phẩm Thời Trang</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <main class="container">
    
        <!-- THÔNG BÁO FLASH MESSAGE -->
        <?php if (!empty($_SESSION['flash_success'])): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($_SESSION['flash_success']) ?>
            </div>
            <?php unset($_SESSION['flash_success']); ?>
        <?php endif; ?>

        <?php if (!empty($_SESSION['flash_error'])): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($_SESSION['flash_error']) ?>
            </div>
            <?php unset($_SESSION['flash_error']); ?>
        <?php endif; ?>

        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <strong>Vui lòng kiểm tra lại:</strong>
                <ul>
                    <?php foreach ($errors as $err): ?>
                        <li><?= htmlspecialchars($err) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- KHUNG TRÊN: GIỚI THIỆU & FORM -->
        <div class="top-wrapper">
            
            <!-- CỘT TRÁI: HEADER & BANNER -->
            <div class="intro-column">
                <header class="main-header">
                    <h1>
                        <strong>
                            HỆ THỐNG<br>
                            QUẢN LÝ CỬA HÀNG<br>
                            SẢN PHẨM THỜI TRANG<br>
                        </strong>
                    </h1>
                    <p>
                        Nền tảng quản trị danh mục quần áo, giày dép và phụ kiện thời trang.<br>
                        Hỗ trợ CRUD dữ liệu sản phẩm nhanh chóng, phục vụ báo cáo đồ án.
                    </p>
                    <figure>
                        <img src="assets/images/fashion.png" alt="Cửa hàng thời trang và phụ kiện" class="banner-img">
                        <figcaption><small>Không gian trưng bày bộ sưu tập thời trang & phụ kiện mới nhất</small></figcaption>
                    </figure>
                </header>
            </div>

            <!-- CỘT PHẢI: FORM THÊM / CẬP NHẬT -->
            <div class="form-column">
                <section class="form-section" id="product-form-area">
                    <h2 id="formTitle"><?= isset($editProduct) ? 'Cập Nhật Sản Phẩm #' . htmlspecialchars($editProduct['id']) : 'Thêm Sản Phẩm Mới' ?></h2>
                    
                    <form action="index.php?action=<?= isset($editProduct) ? 'update' : 'store' ?>" method="POST" id="productForm">
                        <input type="hidden" name="id" id="productId" value="<?= htmlspecialchars($editProduct['id'] ?? '') ?>">

                        <div class="form-group">
                            <label for="name">Tên sản phẩm (*):</label>
                            <input type="text" id="name" name="name" placeholder="VD: Áo Thun Cotton Basic" value="<?= htmlspecialchars($editProduct['name'] ?? '') ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="category">Danh mục / Size (*):</label>
                            <select id="category" name="category" required>
                                <option value="">-- Chọn danh mục / Size --</option>
                                <?php 
                                    $categories = [
                                        'Áo' => 'Áo (Size S/M/L)',
                                        'Quần' => 'Quần (Size 29-32)',
                                        'Váy' => 'Váy (Size S/M/L)',
                                        'Áo khoác' => 'Áo khoác (Size M/L/XL)',
                                        'Giày dép' => 'Giày dép (Size 39-43)',
                                        'Phụ kiện' => 'Phụ kiện (FreeSize)'
                                    ];
                                    $selectedCat = $editProduct['category'] ?? '';
                                    foreach ($categories as $catKey => $catLabel):
                                ?>
                                    <option value="<?= $catKey ?>" <?= ($selectedCat === $catKey) ? 'selected' : '' ?>>
                                        <?= $catLabel ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="price">Giá bán (VNĐ) (*):</label>
                            <input type="number" id="price" name="price" placeholder="VD: 250000" min="1000" step="1000" value="<?= htmlspecialchars($editProduct['price'] ?? '') ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="image">Hình ảnh sản phẩm (chọn có sẵn hoặc gõ link):</label>
                            <input type="text" id="image" name="image" list="sample-images" placeholder="VD: assets/images/ao-thun.jpg" value="<?= htmlspecialchars($editProduct['image'] ?? '') ?>">
                            <datalist id="sample-images">
                                <option value="assets/images/ao-thun.jpg">Áo thun cotton</option>
                                <option value="assets/images/quan-jean.jpg">Quần jean slimfit</option>
                                <option value="assets/images/vay-xoe.jpg">Váy xòe công sở</option>
                                <option value="assets/images/ao-khoac.jpg">Áo khoác bomber</option>
                                <option value="assets/images/fashion.png">Logo / Mặc định</option>
                            </datalist>
                            <small class="note-hint">Gợi ý: để trống sẽ tự động lấy ảnh mặc định của shop.</small>
                        </div>

                        <div class="form-group">
                            <label for="description">Mô tả chi tiết:</label>
                            <textarea id="description" name="description" rows="4" placeholder="Chất liệu, màu sắc, kiểu dáng..."><?= htmlspecialchars($editProduct['description'] ?? '') ?></textarea>
                        </div>

                        <div class="form-actions">
                            <input type="submit" class="btn btn-primary" id="btnSubmit" value="<?= isset($editProduct) ? 'Lưu Cập Nhật' : 'Thêm Sản Phẩm' ?>">
                            <?php if (isset($editProduct)): ?>
                                <a href="index.php" class="btn btn-secondary">Hủy bỏ</a>
                            <?php else: ?>
                                <input type="reset" class="btn btn-secondary" id="btnCancel" value="Làm Mới">
                            <?php endif; ?>
                        </div>
                    </form>
                </section>
            </div>

        </div>

        <hr class="divider">

        <!-- VÙNG 2: BẢNG DANH SÁCH SẢN PHẨM (DỮ LIỆU ĐỘNG PHP) -->
        <section class="table-section" id="product-list-area">
            <h2 class="table-title">Danh Sách Sản Phẩm Trong Cửa Hàng</h2>
            
            <table class="product-table" id="productTable">
                <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th width="12%">Hình ảnh</th>
                        <th width="20%">Tên sản phẩm</th>
                        <th width="13%">Danh mục</th>
                        <th width="12%">Giá bán</th>
                        <th width="26%">Mô tả</th>
                        <th width="12%">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($products) && is_array($products)): ?>
                        <?php foreach ($products as $p): ?>
                            <tr>
                                <td class="text-center font-weight-bold"><?= htmlspecialchars($p['id']) ?></td>
                                <td class="text-center">
                                    <?php 
                                        $imgPath = !empty($p['image']) ? $p['image'] : 'assets/images/fashion.png';
                                    ?>
                                    <img src="<?= htmlspecialchars($imgPath) ?>" alt="<?= htmlspecialchars($p['name']) ?>" class="product-img" onerror="this.src='assets/images/fashion.png'">
                                </td>
                                <td class="font-weight-bold"><?= htmlspecialchars($p['name']) ?></td>
                                <td><span class="badge-cat"><?= htmlspecialchars($p['category']) ?></span></td>
                                <td class="product-price"><?= number_format((float)$p['price'], 0, ',', '.') ?> đ</td>
                                <td class="product-desc"><?= nl2br(htmlspecialchars($p['description'] ?? '')) ?></td>
                                <td class="action-buttons text-center">
                                    <a href="index.php?action=edit&id=<?= $p['id'] ?>" class="btn btn-sm btn-edit">Sửa</a>
                                    <a href="index.php?action=delete&id=<?= $p['id'] ?>" class="btn btn-sm btn-delete" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">Xóa</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center empty-notice">
                                Hiện chưa có sản phẩm nào. Hãy dùng form bên trên để thêm sản phẩm mới!
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>

    </main>

    <script src="assets/js/main.js"></script>
</body>
</html>
