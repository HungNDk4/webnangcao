<div class="row">
    <div class="col-lg-12 col-md-12 col-12">
        <div class="border-bottom pb-4 mb-4 d-flex justify-content-between align-items-center">
            <div class="mb-3 mb-lg-0">
                <h1 class="mb-1 h2 fw-bold">Quản lý Vouchers</h1>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-md-12 col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h4 class="mb-0">Thêm Voucher mới</h4>
            </div>
            <div class="card-body">
                <form action="index.php?act=add_voucher" method="post">
                    <div class="mb-3"><label class="form-label">Mã Voucher</label><input type="text" class="form-control" name="code" placeholder="VD: SALE50K" required></div>
                    <div class="mb-3">
                        <label class="form-label">Loại giảm giá</label>
                        <select name="discount_type" class="form-select" required>
                            <option value="percent">Phần trăm (%)</option>
                            <option value="fixed">Số tiền cố định (VNĐ)</option>
                        </select>
                    </div>
                    <div class="mb-3"><label class="form-label">Giá trị giảm</label><input type="number" class="form-control" name="discount_value" min="0" required></div>
                    <div class="mb-3"><label class="form-label">Số lượng</label><input type="number" class="form-control" name="quantity" min="1" required></div>
                    <div class="mb-3"><label class="form-label">Ngày hết hạn</label><input type="date" class="form-control" name="expiry_date" required></div>
                    <button type="submit" class="btn btn-primary">Thêm Voucher</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Danh sách Vouchers</h4>
                <form method="POST" action="index.php?act=admin_vouchers">
                    <div class="input-group">
                        <input type="text" name="search_query" class="form-control" placeholder="Tìm theo mã voucher..."
                            value="<?= htmlspecialchars($search_keyword) ?>">
                        <button type="submit" name="search_submit" class="btn btn-outline-secondary">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Mã Code</th>
                                <th>Loại</th>
                                <th>Giá trị</th>
                                <th>Số lượng</th>
                                <th>Hết hạn</th>
                                <th class="text-end">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($list_vouchers) && !empty($list_vouchers)): ?>
                                <?php foreach ($list_vouchers as $voucher_item): ?>
                                    <tr>
                                        <td class="fw-bold"><?= htmlspecialchars($voucher_item['code']) ?></td>
                                        <td><?= ucfirst($voucher_item['discount_type']) ?></td>
                                        <td>
                                            <?php if ($voucher_item['discount_type'] == 'percent'): ?>
                                                <?= $voucher_item['discount_value'] ?>%
                                            <?php else: ?>
                                                <?= number_format($voucher_item['discount_value']) ?>đ
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $voucher_item['quantity'] ?></td>
                                        <td><?= date('d/m/Y', strtotime($voucher_item['expires_at'])) ?></td>
                                        <td class="text-end">
                                            <a href="index.php?act=edit_voucher&id=<?= $voucher_item['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                                            <a href="index.php?act=delete_voucher&id=<?= $voucher_item['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa voucher này?');">Xóa</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">Chưa có voucher nào.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>