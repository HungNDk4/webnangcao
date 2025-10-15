<main class="container py-5">
    <div class="row">
        <div class="col-md-6 mb-4">
            <img src="../view/image/<?= htmlspecialchars($product['image']) ?>" class="img-fluid rounded shadow-sm">
        </div>
        <div class="col-md-6 mb-4">
            <h2><?= htmlspecialchars($product['name']) ?></h2>
            <p class="fs-4 text-danger fw-bold"><?= number_format($product['price']) ?> VNĐ</p>
            <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>
            <form action="index.php?act=add_to_cart" method="post" class="mt-4">
                <input type="hidden" name="id" value="<?= $product['id'] ?>">
                <input type="hidden" name="name" value="<?= htmlspecialchars($product['name']) ?>">
                <input type="hidden" name="price" value="<?= $product['price'] ?>">
                <input type="hidden" name="image" value="<?= htmlspecialchars($product['image']) ?>">
                <?php if ($product['quantity'] > 0): ?>
                    <button type="submit" class="btn btn-primary w-100"><i class="fa-solid fa-cart-shopping"></i> Thêm vào giỏ</button>
                <?php else: ?>
                    <button type="button" class="btn btn-secondary w-100" disabled>Hết hàng</button>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <hr class="my-5">

    <div class="row">
        <div class="col-md-8 mx-auto">
            <h3>Đánh giá sản phẩm</h3>


            <?php if (isset($_SESSION['user'])): ?>
                <?php if ($can_review): ?>
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <form action="index.php?act=add_review" method="post">
                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                <div class="mb-3">
                                    <label class="form-label">Cho điểm:</label>
                                    <div>
                                        <input type="radio" name="rating" value="5" id="rate5"><label for="rate5">★</label>
                                        <input type="radio" name="rating" value="4" id="rate4"><label for="rate4">★</label>
                                        <input type="radio" name="rating" value="3" id="rate3"><label for="rate3">★</label>
                                        <input type="radio" name="rating" value="2" id="rate2"><label for="rate2">★</label>
                                        <input type="radio" name="rating" value="1" id="rate1"><label for="rate1">★</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="comment" class="form-label">Viết bình luận:</label>
                                    <textarea name="comment" id="comment" class="form-control" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Gửi đánh giá</button>
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning">Bạn cần mua sản phẩm này để có thể để lại đánh giá.</div>
                <?php endif; ?>
            <?php else: ?>
                <div class="alert alert-info">Vui lòng <a href="index.php?act=login">đăng nhập</a> để gửi đánh giá của bạn.</div>
            <?php endif; ?>

            <?php if (isset($reviews) && !empty($reviews)): ?>
                <?php foreach ($reviews as $review): ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($review['fullname']) ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                <?php for ($i = 0; $i < $review['rating']; $i++) echo '★'; ?>
                            </h6>
                            <p class="card-text"><?= nl2br(htmlspecialchars($review['comment'])) ?></p>
                            <small class="text-muted">Vào lúc: <?= date('d/m/Y H:i', strtotime($review['created_at'])) ?></small>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Chưa có đánh giá nào cho sản phẩm này.</p>
            <?php endif; ?>
        </div>
    </div>
</main>