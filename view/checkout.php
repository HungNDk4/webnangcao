<main class="container py-5">
    <h2 class="mb-4">Thông Tin Thanh Toán</h2>
    <form action="index.php?act=place_order" method="post">
        <div class="row">
            <div class="col-md-7">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5>Thông tin giao hàng</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        $fullname = $_SESSION['user']->getFullname();
                        $email = $_SESSION['user']->getEmail();
                        $phone_number = $_SESSION['user']->getPhoneNumber() ?? '';
                        $address = $_SESSION['user']->getAddress() ?? '';
                        ?>
                        <div class="mb-3">
                            <label class="form-label">Họ và tên</label>
                            <input type="text" name="fullname" class="form-control" value="<?= $fullname ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?= $email ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" name="phone_number" class="form-control" value="<?= $phone_number ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Địa chỉ</label>
                            <input type="text" name="address" class="form-control" value="<?= $address ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ghi chú</label>
                            <textarea name="note" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5>Đơn hàng của bạn & Phương thức thanh toán</h5>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <?php
                            $total_price = 0;
                            foreach ($_SESSION['cart'] as $item) {
                                $total_price += $item['price'] * $item['quantity'];
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

                            // LOGIC CHỐNG SỐ ÂM
                            $final_total = $total_price - $discount_amount;
                            $final_total = max(0, $final_total); // Nếu kết quả âm, nó sẽ được đặt lại thành 0
                            ?>

                            <tr>
                                <td>Tạm tính</td>
                                <td class="text-end"><?= number_format($total_price) ?> VNĐ</td>
                            </tr>

                            <?php if ($discount_amount > 0): ?>
                                <tr>
                                    <td>Giảm giá</td>
                                    <td class="text-end">-<?= number_format($discount_amount) ?> VNĐ</td>
                                </tr>
                            <?php endif; ?>

                            <tr class="fw-bold fs-5">
                                <td>Tổng cộng</td>
                                <td class="text-end text-danger"><?= number_format($final_total) ?> VNĐ</td>
                            </tr>
                        </table>
                        <hr>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Chọn phương thức thanh toán</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="payment_cod" value="cod" checked>
                                <label class="form-check-label" for="payment_cod">
                                    Thanh toán khi nhận hàng (COD)
                                </label>
                            </div>
                            <label class="form-check-label text-muted" for="payment_vnpay">
                                Thanh toán qua VNPAY (Đang bảo trì)
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success w-100 fw-bold">ĐẶT HÀNG</button>
                </div>
            </div>
        </div>
        </div>
    </form>
</main>