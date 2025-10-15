<div class="container">
    <div class="row product-section">
        <h2 class="text-center mb-4">Sản phẩm nổi bật</h2>
        <?php
        if (isset($danhsach) && count($danhsach) > 0) {
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
                            <?php if ($rc['sale_price'] > 0) : ?>
                                <div class="card-text product-price mt-auto text-dark "> <del><?= number_format($rc['price']) ?>VND</del>
                                    <br>
                                    <p class=text-primary><?= number_format($rc['sale_price']) ?> VND</p>
                                </div>
                            <?php else : ?>
                                <p class="card-text product-price mt-auto text-warning"> <?= number_format($rc['price']) ?></p>
                            <?php endif ?>
                            <form action="index.php?act=add_to_cart" method="post" class="mt-3">
                                <input type="hidden" name="id" value="<?= $rc['id'] ?>">
                                <input type="hidden" name="name" value="<?= htmlspecialchars($rc['name']) ?>">
                                <input type="hidden" name="price" value="<?= $rc['price'] ?>">
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
            echo "<p class='text-center'>Hiện chưa có sản phẩm nào.</p>";
        }
        ?>
    </div>
</div>