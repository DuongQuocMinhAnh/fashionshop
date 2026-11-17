<?php
$pageTitle = 'Danh sách sản phẩm';
require_once __DIR__ . '/../layout/header.php';
?>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0 text-primary fw-bold">
            <i class="bi bi-box-seam me-2"></i> Danh Sách Sản Phẩm
        </h5>
        <a href="index.php?action=create" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Thêm mới
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3" style="width: 60px;">#ID</th>
                        <th>Tên sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Giá bán</th>
                        <th>Số lượng kho</th>
                        <th>Mô tả</th>
                        <th class="text-end pe-3" style="width: 160px;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($products)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                Chưa có sản phẩm nào. Hãy bấm "Thêm mới" để tạo sản phẩm đầu tiên!
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($products as $item): ?>
                            <tr>
                                <td class="ps-3 fw-semibold text-secondary">#<?= $item['id'] ?></td>
                                <td>
                                    <span class="fw-bold text-dark"><?= htmlspecialchars($item['name']) ?></span>
                                </td>
                                <td>
                                    <span class="badge bg-secondary"><?= htmlspecialchars($item['category']) ?></span>
                                </td>
                                <td class="text-success fw-bold">
                                    <?= number_format($item['price'], 0, ',', '.') ?> đ
                                </td>
                                <td>
                                    <?php if ($item['quantity'] > 10): ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle"><?= $item['quantity'] ?> chiếc</span>
                                    <?php elseif ($item['quantity'] > 0): ?>
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle"><?= $item['quantity'] ?> chiếc</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle">Hết hàng</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-muted small" style="max-width: 250px;">
                                    <?= htmlspecialchars($item['description'] ?? '') ?>
                                </td>
                                <td class="text-end pe-3">
                                    <a href="index.php?action=edit&id=<?= $item['id'] ?>" class="btn btn-sm btn-outline-warning me-1" title="Chỉnh sửa">
                                        <i class="bi bi-pencil-square"></i> Sửa
                                    </a>
                                    <a href="index.php?action=delete&id=<?= $item['id'] ?>" 
                                       class="btn btn-sm btn-outline-danger" 
                                       onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');" 
                                       title="Xóa">
                                        <i class="bi bi-trash"></i> Xóa
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
