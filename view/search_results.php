<section class="mt-8 mb-lg-14 mb-8">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="mb-8">
                    <h3 class="mb-1">Kết quả tìm kiếm cho: "<?= htmlspecialchars($keyword) ?>"</h3>
                </div>
            </div>
        </div>
        <div class="row g-4 row-cols-lg-5 row-cols-2 row-cols-md-3">
            <?php
            if (isset($search_results) && count($search_results) > 0) {
                foreach ($search_results as $rc) {
            ?>
                    <div class="col">
                        <div class="card card-product h-100">
                            <div class="card-body position-relative">
                                <?php if (isset($rc['sale_price']) && $rc['sale_price'] > 0) :
                                    $discount_percentage = round((($rc['price'] - $rc['sale_price']) / $rc['price']) * 100);
                                ?>
                                    <div class="text-center position-absolute top-0 start-0">
                                        <span class="badge bg-danger"><?= $discount_percentage ?>%</span>
                                    </div>
                                <?php endif; ?>
                                <div class="text-center position-relative">
                                    <a href="index.php?act=product_detail&id=<?= $rc['id'] ?>"><img src="../view/image/<?= htmlspecialchars($rc['image']) ?>" alt="<?= htmlspecialchars($rc['name']) ?>" class="mb-3 img-fluid" style="height: 200px; object-fit: cover;"></a>
                                </div>
                                <h2 class="fs-6"><a href="index.php?act=product_detail&id=<?= $rc['id'] ?>" class="text-inherit text-decoration-none"><?= htmlspecialchars($rc['name']) ?></a></h2>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div>
                                        <?php if (isset($rc['sale_price']) && $rc['sale_price'] > 0) : ?>
                                            <span class="text-dark"><?= number_format($rc['sale_price']) ?>đ</span>
                                            <span class="text-decoration-line-through text-muted ms-1"><?= number_format($rc['price']) ?>đ</span>
                                        <?php else : ?>
                                            <span class="text-dark"><?= number_format($rc['price']) ?>đ</span>
                                        <?php endif; ?>
                                    </div>
                                    <form action="index.php?act=add_to_cart" method="post">
                                        <input type="hidden" name="id" value="<?= $rc['id'] ?>">
                                        <input type="hidden" name="name" value="<?= htmlspecialchars($rc['name']) ?>">
                                        <input type="hidden" name="price" value="<?= $rc['price'] ?>">
                                        <input type="hidden" name="sale_price" value="<?= $rc['sale_price'] ?? 0 ?>">
                                        <input type="hidden" name="image" value="<?= htmlspecialchars($rc['image']) ?>">
                                        <?php if ($rc['quantity'] > 0): ?>
                                            <button type="submit" class="btn btn-primary btn-sm"><i class="feather-icon icon-plus"></i> Thêm</button>
                                        <?php else: ?>
                                            <button type="button" class="btn btn-secondary btn-sm" disabled>Hết hàng</button>
                                        <?php endif; ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<p class='col-12 text-center'>Không tìm thấy sản phẩm nào phù hợp.</p>";
            }
            ?>
        </div>
    </div>
</section>