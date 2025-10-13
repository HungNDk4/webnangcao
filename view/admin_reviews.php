<main class="container py-5">
    <h2 class="mb-4">Quản Lý Đánh Giá</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Người đánh giá</th>
                            <th>Bình luận</th>
                            <th class="text-center">Rating</th>
                            <th>Ngày gửi</th>
                            <th class="text-end">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($list_reviews) && count($list_reviews) > 0): ?>
                            <?php foreach ($list_reviews as $review): ?>
                                <tr>
                                    <td><?= htmlspecialchars($review['product_name']) ?></td>
                                    <td><strong><?= htmlspecialchars($review['fullname']) ?></strong></td>
                                    <td><small><?= htmlspecialchars($review['comment']) ?></small></td>
                                    <td class="text-center text-warning">
                                        <?php for ($i = 0; $i < $review['rating']; $i++) echo '★'; ?>
                                    </td>
                                    <td><?= date('d/m/Y', strtotime($review['created_at'])) ?></td>
                                    <td class="text-end">
                                        <a href="index.php?act=delete_review&id=<?= $review['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa đánh giá này?');">
                                            <i class="fas fa-trash-alt"></i> Xóa
                                        </a>
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
</main>