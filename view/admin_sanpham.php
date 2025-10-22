<div class="row">
    <div class="col-lg-12 col-md-12 col-12">
        <div class="border-bottom pb-4 mb-4 d-flex justify-content-between align-items-center">
            <div class="mb-3 mb-lg-0">
                <h1 class="mb-1 h2 fw-bold">Quản lý Sản phẩm</h1>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-12">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <h4 class="mb-3">Thêm Sản Phẩm Mới</h4>
                    <form action="index.php?act=xl_themsp" method="post" enctype="multipart/form-data" class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Tên Sản Phẩm</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Danh Mục</label>
                            <select name="id_danhmuc" class="form-select">
                                <?php foreach ($danhmuc as $rc) : ?>
                                    <option value="<?= $rc["id"] ?>"><?= htmlspecialchars($rc["name"]) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Hình Ảnh</label>
                            <input type="file" name="image" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Giá Gốc</label>
                            <input type="number" min="1" name="price" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Giá Khuyến Mãi</label>
                            <input type="number" min="0" name="sale_price" class="form-control" value="0">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Số Lượng</label>
                            <input type="number" min="0" name="quantity" class="form-control" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Mô tả</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Lưu Sản Phẩm</button>
                        </div>
                    </form>
                </div>
                <hr>
                <div class="mt-4">
                    <h4 class="mb-3">Danh sách Sản phẩm</h4>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <form method="POST" action="index.php?act=admin_sanpham">
                                <div class="input-group">
                                    <input type="text" name="search_query" class="form-control" placeholder="Tìm kiếm theo tên sản phẩm..."
                                        value="<?= htmlspecialchars($search_keyword) // Giữ lại giá trị sau khi tìm 
                                                ?>">
                                    <button type="submit" name="search_submit" class="btn btn-outline-secondary">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover text-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th>Hình ảnh</th>
                                    <th>Tên SP</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th class="text-end">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($danhsach) && count($danhsach) > 0) : ?>
                                    <?php foreach ($danhsach as $rc) : ?>
                                        <tr>
                                            <td><img src="../view/image/<?= htmlspecialchars($rc['image']) ?>" alt="" width="60" class="img-thumbnail"></td>
                                            <td><?= htmlspecialchars($rc['name']) ?></td>
                                            <td>
                                                <?php if (isset($rc['sale_price']) && $rc['sale_price'] > 0): ?>
                                                    <span class="text-danger fw-bold"><?= number_format($rc['sale_price']) ?>đ</span>
                                                    <del class="ms-1 text-muted"><?= number_format($rc['price']) ?>đ</del>
                                                <?php else: ?>
                                                    <span><?= number_format($rc['price']) ?>đ</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= htmlspecialchars($rc['quantity']) ?></td>
                                            <td class="text-end">
                                                <a href="index.php?act=editsp&id=<?= $rc['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                                                <a href="index.php?act=deletesp&id=<?= $rc['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Ní có chắc muốn xóa không?');">Xóa</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Chưa có sản phẩm nào.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    </tbody>
                    </table>
                </div>
                <?php
                // Chỉ hiển thị phân trang khi KHÔNG có tìm kiếm
                // Vì logic tìm kiếm của chúng ta đang trả về tất cả kết quả
                if (empty($search_keyword)):
                ?>
                    <div class="mt-4">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                <li class="page-item <?= ($current_page <= 1) ? 'disabled' : '' ?>">
                                    <a class="page-link" href="index.php?act=admin_products&page=<?= $current_page - 1 ?>">
                                        <span>&laquo;</span>
                                    </a>
                                </li>

                                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                    <li class="page-item <?= ($i == $current_page) ? 'active' : '' ?>">
                                        <a class="page-link" href="index.php?act=admin_products&page=<?= $i ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>

                                <li class="page-item <?= ($current_page >= $total_pages) ? 'disabled' : '' ?>">
                                    <a class="page-link" href="index.php?act=admin_products&page=<?= $current_page + 1 ?>">
                                        <span>&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                <?php endif; // Đóng thẻ if của phân trang 
                ?>

            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>