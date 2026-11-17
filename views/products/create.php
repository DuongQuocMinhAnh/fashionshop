<?php
$pageTitle = 'Thêm sản phẩm mới';
require_once __DIR__ . '/../layout/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 text-primary fw-bold">
                    <i class="bi bi-plus-circle me-2"></i> Thêm Sản Phẩm Mới
                </h5>
            </div>
            <div class="card-body p-4">
                <form action="index.php?action=store" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Tên sản phẩm <span class="text-danger">*</span></label>
                        <input type="text" class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>" 
                               id="name" name="name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" placeholder="Ví dụ: Áo Sơ Mi Oxford">
                        <?php if (isset($errors['name'])): ?>
                            <div class="invalid-feedback"><?= $errors['name'] ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="category" class="form-label fw-semibold">Danh mục <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?= isset($errors['category']) ? 'is-invalid' : '' ?>" 
                                   id="category" name="category" value="<?= htmlspecialchars($_POST['category'] ?? '') ?>" placeholder="Áo, Quần, Váy...">
                            <?php if (isset($errors['category'])): ?>
                                <div class="invalid-feedback"><?= $errors['category'] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="price" class="form-label fw-semibold">Giá bán (VNĐ) <span class="text-danger">*</span></label>
                            <input type="number" step="1000" min="0" class="form-control <?= isset($errors['price']) ? 'is-invalid' : '' ?>" 
                                   id="price" name="price" value="<?= htmlspecialchars($_POST['price'] ?? '') ?>" placeholder="250000">
                            <?php if (isset($errors['price'])): ?>
                                <div class="invalid-feedback"><?= $errors['price'] ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="quantity" class="form-label fw-semibold">Số lượng trong kho <span class="text-danger">*</span></label>
                        <input type="number" min="0" class="form-control <?= isset($errors['quantity']) ? 'is-invalid' : '' ?>" 
                               id="quantity" name="quantity" value="<?= htmlspecialchars($_POST['quantity'] ?? '10') ?>">
                        <?php if (isset($errors['quantity'])): ?>
                            <div class="invalid-feedback"><?= $errors['quantity'] ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold">Mô tả sản phẩm</label>
                        <textarea class="form-control" id="description" name="description" rows="3" 
                                  placeholder="Nhập thông tin chi tiết về chất liệu, kiểu dáng..."><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <a href="index.php" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Quay lại
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save me-1"></i> Lưu sản phẩm
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
