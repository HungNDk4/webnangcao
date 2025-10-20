<div class="mt-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="index.php?act=view_cart">Giỏ hàng</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Thanh toán</li>
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
                <div>
                    <div class="mb-8">
                        <h1 class="fw-bold">Thông Tin Thanh Toán</h1>
                    </div>
                </div>
            </div>
        </div>
        <form action="index.php?act=place_order" method="post" class="row">
            <div class="col-lg-7 col-md-12">
                <div class="card card-body border-0 shadow-sm">
                    <h4 class="mb-4">Thông tin giao hàng</h4>

                    <?php
                    // Lấy thông tin người dùng đã đăng nhập để điền sẵn
                    $fullname = $_SESSION['user']->getFullname() ?? '';
                    $email = $_SESSION['user']->getEmail() ?? '';
                    $phone_number = $_SESSION['user']->getPhoneNumber() ?? '';
                    $address = $_SESSION['user']->getAddress() ?? '';
                    ?>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="fname">Họ và tên</label>
                            <input type="text" id="fname" class="form-control" name="fullname" value="<?= htmlspecialchars($fullname) ?>" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" id="email" class="form-control" name="email" value="<?= htmlspecialchars($email) ?>" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="phone">Số điện thoại</label>
                            <input type="text" id="phone" class="form-control" name="phone_number" value="<?= htmlspecialchars($phone_number) ?>" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="address">Địa chỉ</label>
                            <input type="text" id="address" class="form-control" name="address" value="<?= htmlspecialchars($address) ?>" required>
                        </div>
                        <div class="col-md-12">
                            <label for="comments" class="form-label">Ghi chú</label>
                            <textarea class="form-control" id="comments" name="note" rows="3" placeholder="Ghi chú về đơn hàng của bạn..."></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 col-md-12">
                <div class="card mt-4 mt-lg-0 border-0 shadow-sm">
                    <div class="card-body">
                        <h4 class="mb-4">Tóm tắt đơn hàng</h4>

                        <?php
                        $total_price = 0;
                        foreach ($_SESSION['cart'] as $item) {
                            $total_price += $item['price'] * $item['quantity'];
                            echo '
                            <div class="d-flex justify-content-between mb-2">
                                <span>' . htmlspecialchars($item['name']) . ' <span class="text-muted">x' . $item['quantity'] . '</span></span>
                                <span>' . number_format($item['price'] * $item['quantity']) . 'đ</span>
                            </div>';
                        }

                        $discount_amount = 0;
                        if (isset($_SESSION['voucher'])) {
                            $voucher = $_SESSION['voucher'];
                            if ($voucher['discount_type'] == 'percent') {
                                $discount_amount = ($total_price * $voucher['discount_value']) / 100;
                            } else {
                                $discount_amount = $voucher['discount_value'];
                            }
                        }
                        $final_total = max(0, $total_price - $discount_amount);
                        ?>

                        <hr class="my-4">

                        <div class="d-flex justify-content-between mb-2">
                            <span>Tạm tính</span>
                            <span class="fw-bold"><?= number_format($total_price) ?>đ</span>
                        </div>

                        <?php if (isset($_SESSION['voucher'])): ?>
                            <div class="d-flex justify-content-between mb-2 text-success">
                                <span>Giảm giá (<?= htmlspecialchars($_SESSION['voucher']['code']) ?>)</span>
                                <span>-<?= number_format($discount_amount) ?>đ</span>
                            </div>
                        <?php endif; ?>

                        <hr>

                        <div class="d-flex justify-content-between">
                            <h5 class="mb-0">Tổng cộng</h5>
                            <h5 class="mb-0 text-dark"><?= number_format($final_total) ?>đ</h5>
                        </div>

                        <hr>

                        <div>
                            <h4 class="mb-3">Phương thức thanh toán</h4>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="payment_cod" value="cod" checked>
                                <label class="form-check-label" for="payment_cod">Thanh toán khi nhận hàng (COD)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="payment_vnpay" value="vnpay" disabled>
                                <label class="form-check-label text-muted" for="payment_vnpay">Thanh toán VNPAY (Đang bảo trì)</label>
                            </div>
                        </div>

                        <div class="mt-4 d-grid">
                            <button type="submit" class="btn btn-primary">ĐẶT HÀNG</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>