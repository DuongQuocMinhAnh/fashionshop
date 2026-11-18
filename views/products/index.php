<!-- TỆP GIAO DIỆN THUẦN HTML: views/products/index.html
     PHỤ TRÁCH: Mai Trang (HTML5 Semantic + Khung hiển thị Form & Bảng)
     Thẻ ngữ nghĩa sử dụng: <main>, <header>, <section>, <form>, <table>, <figure>

     Gửi Hoàng Phúc (CSS & JS):
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
                        <h2 id="formTitle">Thêm Sản Phẩm Mới</h2>
                        
                        <form action="#" method="POST" id="productForm">
                            <input type="hidden" name="id" id="productId" value="">

                            <div class="form-group">
                                <label for="name">Tên sản phẩm (*):</label><br>
                                <input type="text" id="name" name="name" size="35" placeholder="VD: Áo Thun Cotton Basic" required>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="category">Danh mục / Size (*):</label><br>
                                <select id="category" name="category" required>
                                    <option value="">-- Chọn danh mục / Size --</option>
                                    <option value="Áo">Áo (Size S/M/L)</option>
                                    <option value="Quần">Quần (Size 29-32)</option>
                                    <option value="Váy">Váy (Size S/M/L)</option>
                                    <option value="Áo khoác">Áo khoác (Size M/L/XL)</option>
                                    <option value="Giày dép">Giày dép (Size 39-43)</option>
                                    <option value="Phụ kiện">Phụ kiện (FreeSize)</option>
                                </select>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="price">Giá bán (VNĐ) (*):</label><br>
                                <input type="number" id="price" name="price" placeholder="VD: 250000" min="1000" required>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="image">Hình ảnh sản phẩm (Link / Tên tệp):</label><br>
                                <input type="text" id="image" name="image" size="35" placeholder="VD: assets/images/ao-thun.jpg">
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="description">Mô tả chi tiết:</label><br>
                                <textarea id="description" name="description" rows="12" cols="55" placeholder="Chất liệu, màu sắc, kiểu dáng..."></textarea>
                            </div>
                            <br>

                            <!-- Cụm nút bấm dùng thẻ <input> chuẩn HTML5 -->
                            <div class="form-actions">
                                <input type="submit" class="btn btn-primary" id="btnSubmit" value="Thêm Sản Phẩm">
                                <input type="reset" class="btn btn-secondary" id="btnCancel" value="Làm Mới">
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
                    <!-- Dữ liệu mẫu tĩnh để hiển thị khung bảng -->
                    <tr>
                        <td align="center">1</td>
                        <td align="center">
                            <img src="assets/images/ao-thun.jpg" alt="Áo Thun Cotton Basic" class="product-img" width="60" height="60">
                        </td>
                        <td>Áo Thun Cotton Basic</td>
                        <td>Áo</td>
                        <td>250.000 đ</td>
                        <td>Chất liệu cotton 100% co giãn 4 chiều, thoáng mát.</td>
                        <td class="action-buttons" align="center">
                            <input type="button" class="btn btn-edit" value="Sửa">
                            <input type="button" class="btn btn-delete" value="Xóa">
                        </td>
                    </tr>
                    <tr>
                        <td align="center">2</td>
                        <td align="center">
                            <img src="assets/images/quan-jean.jpg" alt="Quần Jean Ống Đứng" class="product-img" width="60" height="60">
                        </td>
                        <td>Quần Jean Ống Đứng</td>
                        <td>Quần</td>
                        <td>450.000 đ</td>
                        <td>Vải denim dày dặn, đứng form, dễ phối đồ.</td>
                        <td class="action-buttons" align="center">
                            <input type="button" class="btn btn-edit" value="Sửa">
                            <input type="button" class="btn btn-delete" value="Xóa">
                        </td>
                    </tr>
                    <tr>
                        <td align="center">3</td>
                        <td align="center">
                            <span>Chưa có ảnh</span>
                        </td>
                        <td>Túi Tote Vải Canvas</td>
                        <td>Phụ kiện</td>
                        <td>120.000 đ</td>
                        <td>Vải bố dày bền, đựng vừa laptop 14 inch.</td>
                        <td class="action-buttons" align="center">
                            <input type="button" class="btn btn-edit" value="Sửa">
                            <input type="button" class="btn btn-delete" value="Xóa">
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>

    </main>

</body>
</html>