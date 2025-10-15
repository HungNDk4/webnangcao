<div class="container">
    <div class="row product-section">
        <h2 class="text-center mb-4">
            Sản phẩm trong danh mục: "<?= htmlspecialchars($category_info['name'] ?? 'Không rõ') ?>"
        </h2>

        <?php
        if (isset($danhsach) && count($danhsach) > 0) {
            // Vòng lặp hiển thị sản phẩm (giữ nguyên như trang chủ)
            foreach ($danhsach as $rc) {
        ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="card product-card h-100">
                        <img src="../view/image/<?= htmlspecialchars($rc['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($rc['name']) ?>">
                        <div class="card-body d-flex flex-column">

                            <h5 class="card-title product-name">
                                <a href="index.php?act=product_detail&id=<?= $rc['id'] ?>" class="text-decoration-none text-dark">
                                    <?= htmlspecialchars($rc['name']) ?>
                                </a>
                            </h5>
                            <?php if (isset($rc['sale_price']) && $rc['sale_price'] > 0) : ?>
                                <div class="card-text product-price mt-auto">
                                    <del><?= number_format($rc['price']) ?> VNĐ</del>
                                    <strong class="text-danger ms-2"><?= number_format($rc['sale_price']) ?> VNĐ</strong>
                                </div>
                            <?php else : ?>
                                <p class="card-text product-price mt-auto"><?= number_format($rc['price']) ?> VNĐ</p>
                            <?php endif ?>
                            <form action="index.php?act=add_to_cart" method="post" class="mt-3">
                                <input type="hidden" name="id" value="<?= $rc['id'] ?>">
                                <input type="hidden" name="name" value="<?= htmlspecialchars($rc['name']) ?>">
                                <input type="hidden" name="price" value="<?= ($rc['sale_price'] > 0) ? $rc['sale_price'] : $rc['price'] ?>">
                                <input type="hidden" name="image" value="<?= htmlspecialchars($rc['image']) ?>">

                                <?php if ($rc['quantity'] > 0): ?>
                                    <button type="submit" class="btn btn-primary w-100"><i class="fa-solid fa-cart-shopping"></i> Thêm vào giỏ</button>
                                <?php else: ?>
                                    <button type="button" class="btn btn-secondary w-100" disabled>Hết hàng</button>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            echo "<p class='text-center'>Chưa có sản phẩm nào trong danh mục này.</p>";
        }
        ?>
    </div>
</div>