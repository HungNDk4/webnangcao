<main class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-warning">
                    <h4 class="mb-0">Chỉnh Sửa Sản Phẩm</h4>
                </div>
                <div class="card-body p-4">
                    <form action="index.php?act=xl_editsp" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $sanpham_edit['id'] ?>">

                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label for="name" class="form-label">Tên Sản Phẩm</label>
                                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($sanpham_edit['name']) ?>" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="id_danhmuc" class="form-label">Danh Mục</label>
                                <select name="id_danhmuc" class="form-select">
                                    <?php foreach ($danhmuc as $dm) : ?>
                                        <option value="<?= $dm['id'] ?>" <?= ($dm['id'] == $sanpham_edit['category_id']) ? "selected" : "" ?>>
                                            <?= htmlspecialchars($dm['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Giá</label>
                                <input type="number" min="1" name="price" class="form-control" value="<?= $sanpham_edit['price'] ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="quantity" class="form-label">Số Lượng</label>
                                <input type="number" name="quantity" class="form-control" value="<?= $sanpham_edit['quantity'] ?>" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Hình Ảnh Mới (Để trống nếu không đổi)</label>
                            <input type="file" name="image" class="form-control">
                            <input type="hidden" name="old_image" value="<?= htmlspecialchars($sanpham_edit['image']) ?>">
                            <p class="mt-2">Ảnh hiện tại: <img src="../view/image/<?= htmlspecialchars($sanpham_edit['image']) ?>" width="50" class="img-thumbnail"></p>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($sanpham_edit['description']) ?></textarea>
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
                        <div class="d-grid">
                            <button type="submit" class="btn btn-warning btn-lg">Cập Nhật Sản Phẩm</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</main>