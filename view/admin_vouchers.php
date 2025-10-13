<main class="container py-5">
    <h2 class="mb-4">Quản Lý Voucher</h2>

    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="alert alert-danger" role="alert">
            <?= $_SESSION['error_message'] ?>
        </div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success" role="alert">
            <?= $_SESSION['success_message'] ?>
        </div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>
    <div class="row">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card shadow-sm mb-5">
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0">Thêm Voucher Mới</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="index.php?act=xl_add_voucher" method="post">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Mã Code</label>
                                    <input type="text" name="code" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Số Lượng</label>
                                    <input type="number" name="quantity" class="form-control" min="1" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Loại Giảm Giá</label>
                                    <select name="discount_type" class="form-select">
                                        <option value="fixed">Số tiền cố định (VNĐ)</option>
                                        <option value="percent">Phần trăm (%)</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Giá trị giảm</label>
                                    <input type="number" name="discount_value" class="form-control" min="0" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Ngày Hết Hạn</label>
                                    <input type="datetime-local" name="expires_at" class="form-control" required>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-info text-white">Thêm Voucher</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header">
                        <h4 class="mb-0">Danh sách Voucher</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>Mã Code</th>
                                    <th>Giá trị</th>
                                    <th>Loại</th>
                                    <th>Số lượng</th>
                                    <th>Hết hạn</th>
                                    <th class="text-end">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($list_vouchers) && count($list_vouchers) > 0): ?>
                                    <?php foreach ($list_vouchers as $v): ?>
                                        <tr>
                                            <td><strong><?= htmlspecialchars($v['code']) ?></strong></td>
                                            <td><?= ($v['discount_type'] == 'percent') ? $v['discount_value'] . '%' : number_format($v['discount_value']) . ' VNĐ' ?></td>
                                            <td><?= $v['discount_type'] ?></td>
                                            <td><?= $v['quantity'] ?></td>
                                            <td><?= date('d/m/Y H:i', strtotime($v['expires_at'])) ?></td>
                                            <td class="text-end">
                                                <a href="index.php?act=edit_voucher&id=<?= $v['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                                                <a href="index.php?act=delete_voucher&id=<?= $v['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Xóa voucher này?');">Xóa</a>
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