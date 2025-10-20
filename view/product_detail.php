<div class="mt-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="index.php?act=hienthi_sp">Sản phẩm</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($product['name']) ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="mt-8">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body p-0">
                        <img src="../view/image/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="img-fluid rounded">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="ps-lg-10 mt-6 mt-md-0">
                    <h1 class="mb-1"><?= htmlspecialchars($product['name']) ?></h1>
                    <div class="mb-4">
                    </div>
                    <div class="fs-4">
                        <?php if (isset($product['sale_price']) && $product['sale_price'] > 0) : ?>
                            <span class="fw-bold text-dark"><?= number_format($product['sale_price']) ?>đ</span>
                            <span class="text-decoration-line-through text-muted ms-1"><?= number_format($product['price']) ?>đ</span>
                        <?php else : ?>
                            <span class="fw-bold text-dark"><?= number_format($product['price']) ?>đ</span>
                        <?php endif; ?>
                    </div>
                    <hr class="my-6">
                    <div>
                        <form action="index.php?act=add_to_cart" method="post">
                            <input type="hidden" name="id" value="<?= $product['id'] ?>">
                            <input type="hidden" name="name" value="<?= htmlspecialchars($product['name']) ?>">
                            <input type="hidden" name="price" value="<?= $product['price'] ?>">
                            <input type="hidden" name="sale_price" value="<?= $product['sale_price'] ?? 0 ?>">
                            <input type="hidden" name="image" value="<?= htmlspecialchars($product['image']) ?>">

                            <?php if ($product['quantity'] > 0): ?>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="feather-icon icon-shopping-bag me-2"></i>Thêm vào giỏ hàng
                                    </button>
                                </div>
                            <?php else: ?>
                                <div class="d-grid">
                                    <button type="button" class="btn btn-secondary" disabled>Hết hàng</button>
                                </div>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mt-lg-14 mt-8">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills nav-lb-tab" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="product-tab" data-bs-toggle="tab" data-bs-target="#product-tab-pane" type="button" role="tab" aria-controls="product-tab-pane" aria-selected="true">Mô tả sản phẩm</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews-tab-pane" type="button" role="tab" aria-controls="reviews-tab-pane" aria-selected="false">
                            Đánh giá
                            <span class="badge bg-light-info text-dark-info rounded-pill ms-2"><?= count($reviews) ?></span>
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="product-tab-pane" role="tabpanel" aria-labelledby="product-tab" tabindex="0">
                        <div class="my-8">
                            <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="reviews-tab-pane" role="tabpanel" aria-labelledby="reviews-tab" tabindex="0">
                        <div class="my-8">
                            <div class="mb-10">
                                <?php if (isset($reviews) && !empty($reviews)): ?>
                                    <?php foreach ($reviews as $review): ?>
                                        <div class="d-flex border-bottom pb-6 mb-6">
                                            <div class="ms-5">
                                                <h6 class="mb-1"><?= htmlspecialchars($review['fullname']) ?></h6>
                                                <p class="small"><span class="text-muted"><?= date('d/m/Y', strtotime($review['created_at'])) ?></span></p>
                                                <div class="mb-2">
                                                    <?php for ($i = 0; $i < 5; $i++): ?>
                                                        <i class="bi bi-star-fill <?= ($i < $review['rating']) ? 'text-warning' : 'text-muted' ?>"></i>
                                                    <?php endfor; ?>
                                                </div>
                                                <p><?= nl2br(htmlspecialchars($review['comment'])) ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p>Chưa có đánh giá nào cho sản phẩm này.</p>
                                <?php endif; ?>
                            </div>
                            <div>
                                <?php if (isset($_SESSION['user'])): ?>
                                    <?php if ($can_review): ?>
                                        <h3 class="mb-5">Gửi đánh giá của bạn</h3>
                                        <form action="index.php?act=add_review" method="post">
                                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <label for="comment" class="form-label">Bình luận của bạn</label>
                                                    <textarea name="comment" id="comment" class="form-control" rows="3" placeholder="Viết bình luận tại đây..." required></textarea>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Cho điểm (Rating)</label>
                                                    <select class="form-select" name="rating" required>
                                                        <option value="">Chọn số sao</option>
                                                        <option value="5">5 Sao</option>
                                                        <option value="4">4 Sao</option>
                                                        <option value="3">3 Sao</option>
                                                        <option value="2">2 Sao</option>
                                                        <option value="1">1 Sao</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
                                                </div>
                                            </div>
                                        </form>
                                    <?php else: ?>
                                        <div class="alert alert-warning">Bạn cần mua sản phẩm này để có thể để lại đánh giá.</div>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <div class="alert alert-info">Vui lòng <a href="index.php?act=login">đăng nhập</a> để gửi đánh giá của bạn.</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>