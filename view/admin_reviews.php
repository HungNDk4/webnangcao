<div class="row">
    <div class="col-lg-12 col-md-12 col-12">
        <div class="border-bottom pb-4 mb-4 d-flex justify-content-between align-items-center">
            <div class="mb-3 mb-lg-0">
                <h1 class="mb-1 h2 fw-bold">Quản lý Đánh giá</h1>
                <form method="POST" action="index.php?act=admin_reviews">
                    <div class="input-group">
                        <input type="text" name="search_query" class="form-control" placeholder="Tìm theo tên SP, email, nội dung..."
                            value="<?= htmlspecialchars($search_keyword) // Giữ lại từ khóa đã tìm 
                                    ?>">
                        <button type="submit" name="search_submit" class="btn btn-outline-secondary">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover text-nowrap">
                        <thead class="table-light">
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Người đánh giá</th>
                                <th>Rating</th>
                                <th>Nội dung</th>
                                <th>Ngày</th>
                                <th class="text-end">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($list_reviews) && !empty($list_reviews)): ?>
                                <?php foreach ($list_reviews as $review): ?>
                                    <tr>
                                        <td>
                                            <a href="index.php?act=product_detail&id=<?= $review['product_id'] ?>" class="text-inherit">
                                                <div class="d-flex align-items-center">
                                                    <img src="../view/image/<?= htmlspecialchars($review['product_image']) ?>" alt="" class="img-fluid" style="width: 40px; height: 40px; object-fit: cover;">
                                                    <span class="ms-2 text-truncate" style="max-width: 200px;"><?= htmlspecialchars($review['product_name']) ?></span>
                                                </div>
                                            </a>
                                        </td>
                                        <td><?= htmlspecialchars($review['fullname']) ?></td>
                                        <td>
                                            <?php for ($i = 0; $i < 5; $i++): ?>
                                                <i class="bi bi-star-fill <?= ($i < $review['rating']) ? 'text-warning' : 'text-muted' ?>"></i>
                                            <?php endfor; ?>
                                        </td>
                                        <td class="text-wrap" style="min-width: 300px;"><?= htmlspecialchars($review['comment']) ?></td>
                                        <td><?= date('d/m/Y', strtotime($review['created_at'])) ?></td>
                                        <td class="text-end">
                                            <a href="index.php?act=delete_review&id=<?= $review['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa đánh giá này?');">Xóa</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">Chưa có đánh giá nào.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>