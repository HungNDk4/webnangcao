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
                </div>
            </div>
        </div>
    </div>
</div>