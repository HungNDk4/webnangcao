<section class="mt-8">
    <div class="container">
        <div class="hero-slider">
            <div style="background: url(../assets/images/slider/slide-1.jpg) no-repeat; background-size: cover; border-radius: 0.5rem; background-position: center">
                <div class="ps-lg-12 py-lg-16 col-xxl-5 col-md-7 py-14 px-8 text-xs-center">
                    <span class="badge text-bg-warning">Đại tiệc khai trương - Giảm 50%</span>
                    <h2 class="text-dark display-5 fw-bold mt-4">Thực Phẩm Tươi Sạch <br> Cho Mọi Nhà</h2>
                    <p class="lead">Trải nghiệm mô hình mua sắm trực tuyến mới, giao hàng tiện lợi tận nhà.</p>
                    <a href="index.php?act=hienthi_sp" class="btn btn-dark mt-3">
                        Mua sắm ngay
                        <i class="feather-icon icon-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
            <div style="background: url(../assets/images/slider/slider-2.jpg) no-repeat; background-size: cover; border-radius: 0.5rem; background-position: center">
                <div class="ps-lg-12 py-lg-16 col-xxl-5 col-md-7 py-14 px-8 text-xs-center">
                    <span class="badge text-bg-warning">Miễn phí vận chuyển - Đơn hàng trên 500.000đ</span>
                    <h2 class="text-dark display-5 fw-bold mt-4">Miễn Phí Giao Hàng <br />với đơn hàng <span class="text-primary">trên 500.000đ</span></h2>
                    <!-- <p class="lead">Giao hàng miễn phí nhanh chóng, áp dụng cho mọi đơn hàng đủ điều kiện.</p> -->
                    <a href="index.php?act=hienthi_sp" class="btn btn-dark mt-3">
                        Mua sắm ngay
                        <i class="feather-icon icon-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if (isset($sanpham_khuyenmai) && !empty($sanpham_khuyenmai)): ?>
    <section class="mt-8 mb-lg-14 mb-8">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="mb-8">
                        <h3 class="mb-1 text-danger">Đang Khuyến Mãi</h3>
                        <p>Săn ngay những deal tốt nhất!</p>
                    </div>
                </div>
            </div>
            <div class="row g-4 row-cols-lg-5 row-cols-2 row-cols-md-3">
                <?php foreach ($sanpham_khuyenmai as $rc): ?>
                    <div class="col">
                        <div class="card card-product h-100">
                            <div class="card-body position-relative">
                                <?php
                                $discount_percentage = round((($rc['price'] - $rc['sale_price']) / $rc['price']) * 100);
                                ?>
                                <div class="position-absolute top-0 start-0 p-2" style="z-index: 10;">
                                    <span class="badge bg-danger"><?= $discount_percentage ?>%</span>
                                </div>
                                <div class="text-center position-relative">
                                    <a href="index.php?act=product_detail&id=<?= $rc['id'] ?>">
                                        <img src="../view/image/<?= htmlspecialchars($rc['image']) ?>" alt="<?= htmlspecialchars($rc['name']) ?>" class="mb-3 img-fluid" style="height: 200px; object-fit: cover;">
                                    </a>
                                </div>
                                <h2 class="fs-6"><a href="index.php?act=product_detail&id=<?= $rc['id'] ?>" class="text-inherit text-decoration-none"><?= htmlspecialchars($rc['name']) ?></a></h2>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div>
                                        <span class="text-dark"><?= number_format($rc['sale_price']) ?>đ</span>
                                        <span class="text-decoration-line-through text-muted ms-1"><?= number_format($rc['price']) ?>đ</span>
                                    </div>
                                    <form action="index.php?act=add_to_cart" method="post">
                                        <input type="hidden" name="id" value="<?= $rc['id'] ?>">
                                        <input type="hidden" name="name" value="<?= htmlspecialchars($rc['name']) ?>">
                                        <input type="hidden" name="price" value="<?= $rc['price'] ?>">
                                        <input type="hidden" name="sale_price" value="<?= $rc['sale_price'] ?? 0 ?>">
                                        <input type="hidden" name="image" value="<?= htmlspecialchars($rc['image']) ?>">
                                        <button type="submit" class="btn btn-primary btn-sm"><i class="feather-icon icon-plus"></i> Thêm</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<section class="mb-lg-14 mb-8">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="mb-8">
                    <h3 class="mb-1">Tất Cả Sản Phẩm</h3>
                    <p>Những sản phẩm tốt nhất đang chờ bạn.</p>
                </div>
            </div>
        </div>
        <div class="row g-4 row-cols-lg-5 row-cols-2 row-cols-md-3">
            <?php
            if (isset($danhsach) && count($danhsach) > 0) {
                foreach ($danhsach as $rc) {
            ?>
                    <div class="col">
                        <div class="card card-product h-100">
                            <div class="card-body position-relative">
                                <?php if (isset($rc['sale_price']) && $rc['sale_price'] > 0) :
                                    $discount_percentage = round((($rc['price'] - $rc['sale_price']) / $rc['price']) * 100);
                                ?>
                                    <div class="position-absolute top-0 start-0 p-2" style="z-index: 10;">
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
                echo "<p class='text-center'>Hiện chưa có sản phẩm nào.</p>";
            }
            ?>
        </div>
    </div>
</section>