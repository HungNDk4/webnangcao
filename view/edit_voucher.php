<main class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-warning">
                    <h4 class="mb-0">Chỉnh Sửa Voucher: <?= htmlspecialchars($voucher_edit['code']) ?></h4>
                </div>
                <div class="card-body p-4">
                    <form action="index.php?act=xl_edit_voucher" method="post">
                        <input type="hidden" name="id" value="<?= $voucher_edit['id'] ?>">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Mã Code</label>
                                <input type="text" name="code" class="form-control" value="<?= htmlspecialchars($voucher_edit['code']) ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Số Lượng</label>
                                <input type="number" name="quantity" class="form-control" min="0" value="<?= $voucher_edit['quantity'] ?>" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Loại Giảm Giá</label>
                                <select name="discount_type" class="form-select">
                                    <option value="fixed" <?= ($voucher_edit['discount_type'] == 'fixed') ? 'selected' : '' ?>>Số tiền (VNĐ)</option>
                                    <option value="percent" <?= ($voucher_edit['discount_type'] == 'percent') ? 'selected' : '' ?>>Phần trăm (%)</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Giá trị giảm</label>
                                <input type="number" name="discount_value" class="form-control" min="0" value="<?= $voucher_edit['discount_value'] ?>" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Ngày Hết Hạn</label>
                                <input type="datetime-local" name="expires_at" class="form-control" value="<?= date('Y-m-d\TH:i', strtotime($voucher_edit['expires_at'])) ?>" required>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-warning">Cập Nhật Voucher</button>
                            <a href="index.php?act=admin_vouchers" class="btn btn-secondary">Hủy</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>