<div class="mt-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="mb-lg-14 mb-8 mt-8">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card py-1 border-0 mb-8">
                    <div>
                        <h1 class="fw-bold">Giỏ Hàng Của Ní</h1>
                    </div>
                </div>
            </div>
        </div>

        <?php if (isset($_SESSION['cart_error'])): ?>
            <div class="alert alert-danger" role="alert">
                <h5 class="alert-heading">Không thể đặt hàng!</h5>
                <p><?= $_SESSION['cart_error'] ?></p>
            </div>
            <?php unset($_SESSION['cart_error']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="table-responsive">
                        <table class="table text-nowrap table-with-checkbox">
                            <thead class="table-light">
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total_price = 0;
                                foreach ($_SESSION['cart'] as $id => $item):
                                    $subtotal = $item['price'] * $item['quantity'];
                                    $total_price += $subtotal;
                                ?>
                                    <tr>
                                        <td class="align-middle">
                                            <div class="d-flex align-items-center">
                                                <a href="index.php?act=product_detail&id=<?= $id ?>">
                                                    <img src="../view/image/<?= htmlspecialchars($item['image']) ?>" alt="" class="icon-shape icon-xxl">
                                                </a>
                                                <div class="ms-3">
                                                    <a href="index.php?act=product_detail&id=<?= $id ?>" class="text-inherit">
                                                        <h6 class="mb-0"><?= htmlspecialchars($item['name']) ?></h6>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle"><?= number_format($item['price']) ?>đ</td>
                                        <td class="align-middle">
                                            <form action="index.php?act=update_cart" method="post" class="d-flex align-items-center">
                                                <input type="hidden" name="id_sp" value="<?= $id ?>">
                                                <button type="submit" name="action" value="decrease" class="btn btn-outline-secondary btn-sm">-</button>
                                                <input type="text" value="<?= $item['quantity'] ?>" class="form-control text-center mx-2" style="width: 60px;" readonly>
                                                <button type="submit" name="action" value="increase" class="btn btn-outline-secondary btn-sm">+</button>
                                            </form>
                                        </td>
                                        <td class="align-middle"><?= number_format($subtotal) ?>đ</td>
                                        <td class="align-middle">
                                            <a href="index.php?act=remove_from_cart&id=<?= $id ?>" class="text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="Xóa">
                                                <i class="feather-icon icon-trash-2"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12">
                    <div class="mb-8 card-body">
                        <h4 class="mb-3">Tóm tắt đơn hàng</h4>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tạm tính</span>
                            <span class="fw-bold"><?= number_format($total_price) ?>đ</span>
                        </div>

                        <?php
                        $discount_amount = 0;
                        if (isset($_SESSION['voucher'])) {
                            $voucher = $_SESSION['voucher'];
                            if ($voucher['discount_type'] == 'percent') {
                                $discount_amount = ($total_price * $voucher['discount_value']) / 100;
                            } else {
                                $discount_amount = $voucher['discount_value'];
                            }
                            echo '<div class="d-flex justify-content-between mb-2 text-success">';
                            echo '<span>Giảm giá (' . htmlspecialchars($voucher['code']) . ')</span>';
                            echo '<span>-' . number_format($discount_amount) . 'đ</span>';
                            echo '</div>';
                        }
                        $final_total = max(0, $total_price - $discount_amount);
                        ?>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bolder">Tổng cộng</span>
                            <span class="fw-bolder text-dark"><?= number_format($final_total) ?>đ</span>
                        </div>

                        <form action="index.php?act=apply_voucher" method="post">
                            <div class="input-group mb-3">
                                <input type="text" name="voucher_code" class="form-control" placeholder="Mã giảm giá">
                                <button class="btn btn-dark" type="submit">Áp dụng</button>
                            </div>
                        </form>
                        <?php if (isset($_SESSION['voucher_message'])): ?>
                            <div class="alert alert-danger small p-2"><?= $_SESSION['voucher_message'] ?></div>
                            <?php unset($_SESSION['voucher_message']); ?>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['voucher'])): ?>
                            <div class="alert alert-success small p-2">
                                Đã áp dụng mã: <b><?= htmlspecialchars($_SESSION['voucher']['code']) ?></b>
                                <a href="index.php?act=remove_voucher" class="float-end text-danger fw-bold">Xóa</a>
                            </div>
                        <?php endif; ?>

                        <div class="d-grid mt-4">
                            <a href="index.php?act=checkout" class="btn btn-primary btn-lg">Tiến hành thanh toán</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-12 text-center">
                    <img src="../assets/images/svg-graphics/delivery-boy.svg" alt="" style="max-width: 250px;">
                    <h4 class="mt-4">Giỏ hàng của ní đang trống trơn!</h4>
                    <p>Có vẻ như bạn chưa thêm sản phẩm nào vào giỏ hàng.</p>
                    <a href="index.php" class="btn btn-primary">Tiếp tục mua sắm</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>