<main class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><?= $title ?? 'Bảng Điều Khiển' ?></h2>
        <div>
            <a href="index.php?act=admin_dashboard&filter=today" class="btn btn-outline-secondary">Hôm nay</a>
            <a href="index.php?act=admin_dashboard&filter=week" class="btn btn-outline-secondary">7 ngày</a>
            <a href="index.php?act=admin_dashboard&filter=month" class="btn btn-outline-secondary">Tháng này</a>
            <a href="index.php?act=admin_dashboard&filter=year" class="btn btn-outline-secondary">Năm nay</a>
            <a href="index.php?act=admin_dashboard&filter=all" class="btn btn-outline-secondary">Tất cả</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3 shadow-sm">
                <div class="card-header fs-5">Doanh Thu (Hoàn thành)</div>
                <div class="card-body">
                    <h4 class="card-title"><?= number_format($total_revenue ?? 0) ?> VNĐ</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3 shadow-sm">
                <div class="card-header fs-5">Tổng Đơn Hàng</div>
                <div class="card-body">
                    <h4 class="card-title"><?= $total_orders ?? 0 ?></h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3 shadow-sm">
                <div class="card-header fs-5">Khách Hàng Mới</div>
                <div class="card-body">
                    <h4 class="card-title"><?= $total_customers ?? 0 ?></h4>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-5">

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header">
                    <h5>Top 5 Sản phẩm Bán chạy nhất</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th class="text-end">Đã bán</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($top_sell) && !empty($top_sell)): foreach ($top_sell as $product): ?>
                                    <tr>
                                        <td><img src="../view/image/<?= $product['image'] ?>" width="40" class="me-2 img-thumbnail"><?= $product['name'] ?></td>
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

        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header">
                    <h5>5 Sản phẩm Bán ế nhất</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th class="text-end">Đã bán</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($least_sell) && !empty($least_sell)): foreach ($least_sell as $product): ?>
                                    <tr>
                                        <td><img src="../view/image/<?= $product['image'] ?>" width="40" class="me-2 img-thumbnail"><?= $product['name'] ?></td>
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

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5>Top 5 Sản phẩm Tồn kho nhiều nhất</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th class="text-end">Số lượng tồn</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($top_inventory) && !empty($top_inventory)): foreach ($top_inventory as $product): ?>
                                    <tr>
                                        <td><img src="../view/image/<?= $product['image'] ?>" width="40" class="me-2 img-thumbnail"><?= $product['name'] ?></td>
                                        <td class="text-end fw-bold fs-5"><?= $product['quantity'] ?></td>
                                    </tr>
                                <?php endforeach;
                            else: ?>
                                <tr>
                                    <td colspan="2" class="text-center">Không có dữ liệu tồn kho.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>