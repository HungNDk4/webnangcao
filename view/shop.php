<div class="mt-4">
    <div class="container">
        <div class="row ">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tất cả sản phẩm</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="mt-8 mb-lg-14 mb-8">
    <div class="container">
        <div class="row gx-10">
            <aside class="col-lg-3 col-md-4 mb-6 mb-md-0">
                <div class="offcanvas offcanvas-start offcanvas-collapse w-md-50" tabindex="-1" id="offcanvasCategory" aria-labelledby="offcanvasCategoryLabel">
                    <div class="offcanvas-header d-lg-none">
                        <h5 class="offcanvas-title" id="offcanvasCategoryLabel">Filter</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body ps-lg-2 pt-lg-0">
                        <div class="mb-8">
                            <h5 class="mb-3">Danh mục</h5>
                            <ul class="nav nav-category" id="categoryCollapseMenu">
                                <?php
                                // Dùng biến $danhmuc_for_menu đã có sẵn
                                if (isset($danhmuc_for_menu) && !empty($danhmuc_for_menu)) {
                                    foreach ($danhmuc_for_menu as $dm) {
                                        echo '<li class="nav-item border-bottom w-100"><a href="index.php?act=products_by_cat&id=' . $dm['id'] . '" class="nav-link">' . htmlspecialchars($dm['name']) . '</a></li>';
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </aside>

            <section class="col-lg-9 col-md-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="mb-0">Tất cả sản phẩm</h3>
                </div>

                <div class="row g-4 row-cols-xl-3 row-cols-lg-3 row-cols-2 row-cols-md-2 mt-2">
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
                        echo "<p class='col-12 text-center'>Hiện chưa có sản phẩm nào.</p>";
                    }
                    ?>
                </div>
            </section>
        </div>
    </div>
</div>