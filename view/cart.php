<main class="container py-5">
    <h2 class="mb-4">Giỏ Hàng Của Ní</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <?php
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) :
                $total_price = 0;
            ?>
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 10%;">Hình ảnh</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Đơn Giá</th>
                                <th style="width: 15%;" class="text-center">Số Lượng</th>
                                <th>Thành Tiền</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($_SESSION['cart'] as $id => $item) :
                                $subtotal = $item['price'] * $item['quantity'];
                                $total_price += $subtotal;
                            ?>
                                <tr>
                                    <td><img src="../view/image/<?= htmlspecialchars($item['image']) ?>" class="img-thumbnail" alt=""></td>
                                    <td><?= htmlspecialchars($item['name']) ?></td>
                                    <td><?= number_format($item['price']) ?> VNĐ</td>
                                    <td class="text-center">
                                        <form action="index.php?act=update_cart" method="post" class="d-flex justify-content-center align-items-center">
                                            <input type="hidden" name="id_sp" value="<?= $id ?>">
                                            <button type="submit" name="action" value="decrease" class="btn btn-outline-secondary btn-sm">-</button>
                                            <input type="text" value="<?= $item['quantity'] ?>" class="form-control text-center mx-2" style="width: 50px;" name="quantity" readonly>
                                            <button type="submit" name="action" value="increase" class="btn btn-outline-secondary btn-sm">+</button>
                                        </form>
                                    </td>
                                    <td><?= number_format($subtotal) ?> VNĐ</td>
                                    <td class="text-end">
                                        <a href="index.php?act=remove_from_cart&id=<?= $id ?>" class="btn btn-outline-danger btn-sm" title="Xóa">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr class="fw-bold">
                                <td colspan="4" class="text-end">Tổng Cộng:</td>
                                <td colspan="2"><?= number_format($total_price) ?> VNĐ</td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="row justify-content-end">
                        <div class="col-md-5">
                            <div class="mb-3">
                                <form action="index.php?act=apply_voucher" method="post">
                                    <label class="form-label">Mã giảm giá</label>
                                    <div class="input-group">
                                        <input type="text" name="voucher_code" class="form-control" placeholder="Nhập mã của bạn...">
                                        <button class="btn btn-outline-secondary" type="submit">Áp dụng</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-3">
                            <a href="index.php?act=checkout" class="btn btn-primary">Tiến hành thanh toán</a>
                        </div>

                        <?php if (isset($_SESSION['voucher_message'])): ?>
                            <div class="alert alert-warning"><?= $_SESSION['voucher_message'] ?></div>
                            <?php unset($_SESSION['voucher_message']); ?>
                        <?php endif; ?>

                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Tạm tính:</span>
                                <strong><?= number_format($total_price) ?> VNĐ</strong>
                            </li>
                            <?php
                            $discount_amount = 0;
                            if (isset($_SESSION['voucher'])) {
                                $voucher = $_SESSION['voucher'];
                                if ($voucher['discount_type'] == 'percent') {
                                    $discount_amount = ($total_price * $voucher['discount_value']) / 100;
                                } else {
                                    $discount_amount = $voucher['discount_value'];
                                }
                                echo '<li class="list-group-item d-flex justify-content-between text-success">';
                                echo '<span>Giảm giá (' . $voucher['code'] . '):</span>';
                                echo '<strong>-' . number_format($discount_amount) . ' VNĐ</strong>';
                                echo ' <a href="index.php?act=remove_voucher" class="text-danger">Xóa</a>';
                                echo '</li>';
                            }
                            $final_total = $total_price - $discount_amount;
                            ?>
                            <li class="list-group-item d-flex justify-content-between fs-5">
                                <span><strong>Tổng cộng:</strong></span>
                                <strong class="text-danger"><?= number_format($final_total) ?> VNĐ</strong>
                            </li>
                        </ul>
                    </div>
                </div>
        </div>
    <?php else : ?>
        <div class="text-center p-5">
            <p>Giỏ hàng của ní đang trống trơn!</p>
            <a href="index.php" class="btn btn-primary">Tiếp tục mua sắm</a>
        </div>
    <?php endif; ?>


    </div>
    </div>
</main>