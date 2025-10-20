<div class="row">
    <div class="col-lg-12 col-md-12 col-12">
        <div class="border-bottom pb-4 mb-4 d-flex justify-content-between align-items-center">
            <div class="mb-3 mb-lg-0">
                <h1 class="mb-1 h2 fw-bold">Quản lý Đơn hàng</h1>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover text-nowrap">
                        <thead class="table-light">
                            <tr>
                                <th>Mã ĐH</th>
                                <th>Khách hàng</th>
                                <th>Ngày đặt</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th class="text-end">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($list_orders) && !empty($list_orders)): ?>
                                <?php foreach ($list_orders as $order): ?>
                                    <tr>
                                        <td>#<?= $order['id'] ?></td>
                                        <td><?= htmlspecialchars($order['fullname']) ?></td>
                                        <td><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></td>
                                        <td><?= number_format($order['total_money']) ?>đ</td>
                                        <td>
                                            <form action="index.php?act=update_order_status" method="post" class="d-flex">
                                                <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                                                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                                    <option value="pending" <?= ($order['status'] == 'pending') ? 'selected' : '' ?>>Pending</option>
                                                    <option value="confirmed" <?= ($order['status'] == 'confirmed') ? 'selected' : '' ?>>Confirmed</option>
                                                    <option value="shipping" <?= ($order['status'] == 'shipping') ? 'selected' : '' ?>>Shipping</option>
                                                    <option value="completed" <?= ($order['status'] == 'completed') ? 'selected' : '' ?>>Completed</option>
                                                    <option value="cancelled" <?= ($order['status'] == 'cancelled') ? 'selected' : '' ?>>Cancelled</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td class="text-end">
                                            <a href="index.php?act=order_detail&id=<?= $order['id'] ?>" class="btn btn-info btn-sm">Xem chi tiết</a>
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
                </tbody>
                </table>
            </div>
            <div class="mt-4">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?= ($current_page <= 1) ? 'disabled' : '' ?>">
                            <a class="page-link" href="index.php?act=admin_orders&page=<?= $current_page - 1 ?>">
                                <span>&laquo;</span>
                            </a>
                        </li>
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item <?= ($i == $current_page) ? 'active' : '' ?>">
                                <a class="page-link" href="index.php?act=admin_orders&page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item <?= ($current_page >= $total_pages) ? 'disabled' : '' ?>">
                            <a class="page-link" href="index.php?act=admin_orders&page=<?= $current_page + 1 ?>">
                                <span>&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>