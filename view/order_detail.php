<main class="container py-5">
    <h2 class="mb-4">Chi Tiết Đơn Hàng #<?= $order_info['id'] ?></h2>
    <div class="row">
        <div class="col-md-7">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5>Danh sách sản phẩm</h5>
                </div>
                <div class="card-body">
                    <table class="table align-middle">
                        <tbody>
                            <?php foreach ($order_details as $item): ?>
                                <tr>
                                    <td><img src="../view/image/<?= htmlspecialchars($item['image']) ?>" width="60" class="img-thumbnail"></td>
                                    <td><?= htmlspecialchars($item['name']) ?></td>
                                    <td>Số lượng: <?= $item['quantity'] ?></td>
                                    <td class="text-end"><?= number_format($item['price']) ?> VNĐ</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5>Thông tin giao hàng</h5>
                </div>
                <div class="card-body">
                    <p><strong>Ngày đặt:</strong> <?= date('d/m/Y H:i', strtotime($order_info['created_at'])) ?></p>

                    <p><strong>Trạng thái:</strong>
                        <?php
                        $status = htmlspecialchars($order_info['status']);
                        $badge_class = 'bg-secondary'; // Màu mặc định
                        if ($status == 'completed') {
                            $badge_class = 'bg-success';
                        } elseif ($status == 'shipping') {
                            $badge_class = 'bg-info text-dark';
                        } elseif ($status == 'confirmed') {
                            $badge_class = 'bg-primary';
                        } elseif ($status == 'cancelled') {
                            $badge_class = 'bg-danger';
                        } elseif ($status == 'pending') {
                            $badge_class = 'bg-warning text-dark';
                        }
                        echo "<span class='badge {$badge_class}'>" . ucfirst($status) . "</span>";
                        ?>
                    </p>
                    <p><strong>Người nhận:</strong> <?= htmlspecialchars($order_info['fullname']) ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($order_info['email']) ?></p>
                    <p><strong>Số điện thoại:</strong> <?= htmlspecialchars($order_info['phone_number']) ?></p>
                    <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($order_info['address']) ?></p>
                    <p><strong>Ghi chú:</strong> <?= htmlspecialchars($order_info['note']) ?></p>
                    <hr>
                    <h5 class="text-end">Tổng tiền: <span class="text-danger"><?= number_format($order_info['total_money']) ?> VNĐ</span></h5>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <a href="index.php?act=order_history" class="btn btn-secondary">Quay lại Lịch sử mua hàng</a>
    </div>
</main>