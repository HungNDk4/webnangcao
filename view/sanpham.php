<main class="container py-5">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card shadow-sm mb-5">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Thêm Sản Phẩm Mới</h4>
                </div>
                <div class="card-body p-4">
                    <form action="index.php?act=xl_themsp" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label for="name" class="form-label">Tên Sản Phẩm</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="id_danhmuc" class="form-label">Danh Mục</label>
                                <select name="id_danhmuc" class="form-select">
                                    <?php foreach ($danhmuc as $rc) : ?>
                                        <option value="<?= $rc["id"] ?>"><?= htmlspecialchars($rc["name"]) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Giá Gốc</label>
                                <input type="number" min="1" name="price" class="form-control" value="<?= $sanpham_edit['price'] ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="sale_price" class="form-label">Giá Khuyến Mãi</label>
                                <input type="number" min="0" name="sale_price" class="form-control" value="<?= $sanpham_edit['sale_price'] ?? 0 ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="quantity" class="form-label">Số Lượng</label>
                                <input type="number" name="quantity" class="form-control" value="<?= $sanpham_edit['quantity'] ?>" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Hình Ảnh</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea name="description" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success btn-lg">Lưu Sản Phẩm</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header">
                    <h4 class="mb-0">Danh sách Sản phẩm</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-dark">
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
                                            <td><?= number_format($rc['price']) ?> VNĐ</td>
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
                </div>
            </div>
        </div>
    </div>
</main>