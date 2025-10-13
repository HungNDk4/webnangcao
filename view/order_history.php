<main class="container py-5">
    <h2 class="mb-4">Lịch Sử Đơn Hàng Của Bạn</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Mã Đơn Hàng</th>
                            <th>Ngày Đặt</th>
                            <th>Tổng Tiền</th>
                            <th>Trạng Thái</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($list_orders) && count($list_orders) > 0): ?>
                            <?php foreach ($list_orders as $order): ?>
                                <tr>
                                    <td><strong>#<?= $order['id'] ?></strong></td>
                                    <td><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></td>
                                    <td><?= number_format($order['total_money']) ?> VNĐ</td>
                                    <td>
                                        <span class="badge bg-info text-dark"><?= htmlspecialchars($order['status']) ?></span>
                                    </td>
                                    <td class="text-end">

                                        <?php if ($order['status'] == 'pending'): ?>
                                            <a href="index.php?act=cancel_order&id=<?= $order['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Bạn có chắc muốn hủy đơn hàng này?');">Hủy đơn</a>
                                        <?php endif; ?>

                                        <a href="index.php?act=order_detail&id=<?= $order['id'] ?>" class="btn btn-sm btn-outline-primary">Xem chi tiết</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">Bạn chưa có đơn hàng nào.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>