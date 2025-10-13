<main class="container py-5">
    <h2 class="mb-4">Quản Lý Đơn Hàng</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Mã ĐH</th>
                            <th>Khách Hàng</th>
                            <th>Ngày Đặt</th>
                            <th class="text-end">Tổng Tiền</th>
                            <th class="text-center" style="width: 20%;">Trạng Thái</th>
                            <th class="text-end">Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($list_orders) && count($list_orders) > 0): ?>
                            <?php
                            $status_options = ['pending', 'confirmed', 'shipping', 'completed', 'cancelled'];
                            ?>
                            <?php foreach ($list_orders as $order): ?>
                                <tr>
                                    <td><strong>#<?= $order['id'] ?></strong></td>
                                    <td><?= htmlspecialchars($order['fullname']) ?></td>
                                    <td><?= date('d/m/Y', strtotime($order['created_at'])) ?></td>
                                    <td class="text-end"><?= number_format($order['total_money']) ?> VNĐ</td>
                                    <td class="text-center">
                                        <form action="index.php?act=update_order_status" method="POST">
                                            <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                                <?php foreach ($status_options as $status): ?>
                                                    <option value="<?= $status ?>" <?= ($order['status'] == $status) ? 'selected' : '' ?>>
                                                        <?= ucfirst($status) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="text-end">
                                        <a href="index.php?act=order_detail&id=<?= $order['id'] ?>" class="btn btn-sm btn-outline-primary">Xem</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Chưa có đơn hàng nào.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>