<main class="container py-5">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">Chỉnh Sửa Danh Mục</h4>
                </div>
                <div class="card-body">
                    <form action="index.php?act=xl_editdm" method="post">
                        <input type="hidden" name="id" value="<?= $danhmuc_edit['id'] ?>">
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên danh mục</label>
                            <input type="text" name="name" class="form-control" id="name" value="<?= htmlspecialchars($danhmuc_edit['name']) ?>" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="index.php?act=hienthidm" class="btn btn-secondary me-2">Hủy</a>
                            <button type="submit" class="btn btn-warning">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>