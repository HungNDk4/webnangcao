<div class="row">
    <div class="col-lg-12 col-md-12 col-12">
        <div class="border-bottom pb-4 mb-4 d-md-flex justify-content-between align-items-center">
            <div class="mb-3 mb-md-0">
                <h1 class="mb-1 h2 fw-bold"><?= $title ?? 'Bảng Điều Khiển' ?></h1>
            </div>
            <div class="d-flex">
                <a href="index.php?act=admin_dashboard&filter=today" class="btn btn-outline-secondary">Hôm nay</a>
                <a href="index.php?act=admin_dashboard&filter=week" class="btn btn-outline-secondary ms-2">7 ngày</a>
                <a href="index.php?act=admin_dashboard&filter=month" class="btn btn-outline-secondary ms-2">Tháng này</a>
                <a href="index.php?act=admin_dashboard&filter=year" class="btn btn-outline-secondary ms-2">Năm nay</a>
                <a href="index.php?act=admin_dashboard&filter=all" class="btn btn-outline-secondary ms-2">Tất cả</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-4 col-lg-6 col-md-12 col-12 mb-6">
        <div class="card h-100 card-lg">
            <div class="card-body p-6">
                <div class="d-flex justify-content-between align-items-center mb-6">
                    <div>
                        <h4 class="mb-0 fs-5">Doanh thu</h4>
                    </div>
                    <div class="icon-shape icon-md bg-light-danger text-dark-danger rounded-circle"><i class="fa-solid fa-sack-dollar fs-5"></i></div>
                </div>
                <div class="lh-1">
                    <h1 class="mb-2 fw-bold fs-2"><?= number_format($total_revenue ?? 0) ?> đ</h1>
                    <span>Đơn hàng đã hoàn thành</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-12 col-12 mb-6">
        <div class="card h-100 card-lg">
            <div class="card-body p-6">
                <div class="d-flex justify-content-between align-items-center mb-6">
                    <div>
                        <h4 class="mb-0 fs-5">Tổng đơn hàng</h4>
                    </div>
                    <div class="icon-shape icon-md bg-light-primary text-dark-primary rounded-circle"><i class="fa-solid fa-box fs-5"></i></div>
                </div>
                <div class="lh-1">
                    <h1 class="mb-2 fw-bold fs-2"><?= $total_orders ?? 0 ?></h1>
                    <span>Tất cả trạng thái</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-12 col-12 mb-6">
        <div class="card h-100 card-lg">
            <div class="card-body p-6">
                <div class="d-flex justify-content-between align-items-center mb-6">
                    <div>
                        <h4 class="mb-0 fs-5">Khách hàng mới</h4>
                    </div>
                    <div class="icon-shape icon-md bg-light-warning text-dark-warning rounded-circle"><i class="fa-solid fa-users fs-5"></i></div>
                </div>
                <div class="lh-1">
                    <h1 class="mb-2 fw-bold fs-2"><?= $total_customers ?? 0 ?></h1>
                    <span>Trong khoảng thời gian đã chọn</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-8 col-lg-12 col-md-12 col-12 mb-6">
        <div class="card h-100">
            <div class="card-header">
                <h4 class="mb-0">Đơn hàng gần đây</h4>
            </div>
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($recent_orders) && !empty($recent_orders)): foreach ($recent_orders as $order): ?>
                                    <tr>
                                        <td><a href="index.php?act=admin_order_detail&id=<?= $order['id'] ?>" class="text-inherit">#<?= $order['id'] ?></a></td>
                                        <td><?= htmlspecialchars($order['fullname']) ?></td>
                                        <td><?= date('d/m/Y', strtotime($order['created_at'])) ?></td>
                                        <td><?= number_format($order['total_money']) ?>đ</td>
                                        <td>
                                            <?php
                                            $status = htmlspecialchars($order['status']);
                                            $badge_class = 'bg-secondary';
                                            if ($status == 'completed') $badge_class = 'bg-success';
                                            elseif ($status == 'shipping') $badge_class = 'bg-info';
                                            elseif ($status == 'confirmed') $badge_class = 'bg-primary';
                                            elseif ($status == 'cancelled') $badge_class = 'bg-danger';
                                            elseif ($status == 'pending') $badge_class = 'bg-warning';
                                            echo "<span class='badge {$badge_class}'>" . ucfirst($status) . "</span>";
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach;
                            else: ?>
                                <tr>
                                    <td colspan="5" class="text-center">Chưa có đơn hàng nào.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-lg-12 col-md-12 col-12 mb-6">
        <div class="card h-100">
            <div class="card-header">
                <h4 class="mb-0">Top sản phẩm bán chạy</h4>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <tbody>
                        <?php if (isset($top_sell) && !empty($top_sell)): foreach ($top_sell as $product): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="../view/image/<?= htmlspecialchars($product['image']) ?>" width="40" class="me-3 img-thumbnail rounded">
                                            <span class="fs-6"><?= htmlspecialchars($product['name']) ?></span>
                                        </div>
                                    </td>
                                    <td class="text-end fw-bold"><?= $product['total_sold'] ?></td>
                                </tr>
                            <?php endforeach;
                        else: ?>
                            <tr>
                                <td colspan="2" class="text-center">Không có dữ liệu.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>