<main class="container py-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm mb-5">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Thêm Danh Mục Mới</h4>
                </div>
                <div class="card-body">
                    <form action="index.php?act=themdm" method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên danh mục</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Nhập tên danh mục..." required>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Thêm mới</button>
                    </form>
                </div>
            </div>
            <div class="card shadow-sm">
                <div class="card-header">
                    <h4 class="mb-0">Danh sách Danh mục</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên Danh Mục</th>
                                    <th scope="col" class="text-end">Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($danhmuc) && count($danhmuc) > 0) {
                                    $stt = 1;
                                    foreach ($danhmuc as $rc) {
                                ?>
                                        <tr>
                                            <th scope="row"><?= $stt++ ?></th>
                                            <td><?= htmlspecialchars($rc["name"]) ?></td>
                                            <td class="text-end">
                                                <a href="index.php?act=editdm&id=<?= $rc["id"] ?>" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Sửa
                                                </a>
                                                <a href="index.php?act=xoadm&id=<?= $rc["id"] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Ní có chắc muốn xóa không?');">
                                                    <i class="fas fa-trash-alt"></i> Xóa
                                                </a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='3' class='text-center'>Chưa có danh mục nào.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>