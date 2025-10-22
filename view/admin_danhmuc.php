<div class="row">
    <div class="col-lg-12 col-md-12 col-12">
        <div class="border-bottom pb-4 mb-4 d-flex justify-content-between align-items-center">
            <div class="mb-3 mb-lg-0">
                <h1 class="mb-1 h2 fw-bold">Quản lý Danh mục</h1>
                <form method="POST" action="index.php?act=admin_danhmuc">
                    <div class="input-group">
                        <input type="text" name="search_query" class="form-control" placeholder="Tìm theo tên danh mục..."
                            value="<?= htmlspecialchars($search_keyword) ?>">
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
    <div class="col-lg-4 col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Thêm Danh mục mới</h4>
            </div>
            <div class="card-body">
                <form action="index.php?act=xl_adddm" method="post">
                    <div class="mb-3">
                        <label class="form-label">Tên danh mục</label>
                        <input type="text" class="form-control" name="name_dm" placeholder="Nhập tên danh mục" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-8 col-md-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Danh sách Danh mục</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover text-nowrap">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Tên Danh mục</th>
                                <th class="text-end">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($danhmuc) && !empty($danhmuc)): ?>
                                <?php foreach ($danhmuc as $dm): ?>
                                    <tr>
                                        <td><?= $dm['id'] ?></td>
                                        <td><?= htmlspecialchars($dm['name']) ?></td>
                                        <td class="text-end">
                                            <a href="index.php?act=editdm&id=<?= $dm['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                                            <a href="index.php?act=deletedm&id=<?= $dm['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa không?');">Xóa</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="text-center">Chưa có danh mục nào.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>