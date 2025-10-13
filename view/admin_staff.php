<main class="container py-5">
    <h2 class="mb-4">Quản Lý Nhân Viên</h2>

    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error_message'];
                                        unset($_SESSION['error_message']); ?></div>
    <?php endif; ?>
    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success"><?= $_SESSION['success_message'];
                                            unset($_SESSION['success_message']); ?></div>
    <?php endif; ?>

    <div class="card shadow-sm mb-5">
        <div class="card-header bg-secondary text-white">
            <h4 class="mb-0">Thêm Nhân Viên Mới</h4>
        </div>
        <div class="card-body p-4">
            <form action="index.php?act=xl_add_staff" method="post">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Họ và Tên</label>
                        <input type="text" name="fullname" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Mật khẩu</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Vai trò</label>
                        <select name="role" class="form-select">
                            <option value="staff">Nhân viên (Staff)</option>
                            <option value="admin">Quản trị viên (Admin)</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-secondary">Thêm Nhân Viên</button>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Danh sách Nhân viên & Admin</h4>
        </div>
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Họ và Tên</th>
                        <th>Email</th>
                        <th>Vai trò</th>
                        <th class="text-center">Trạng Thái</th>
                        <th class="text-end">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($list_staff) && count($list_staff) > 0): ?>
                        <?php foreach ($list_staff as $staff): ?>
                            <tr>
                                <td><?= $staff['id'] ?></td>
                                <td><?= htmlspecialchars($staff['fullname']) ?></td>
                                <td><?= htmlspecialchars($staff['email']) ?></td>
                                <td><span class="badge bg-dark"><?= $staff['role'] ?></span></td>
                                <td class="text-center">
                                    <?= ($staff['status'] == 1) ? '<span class="badge bg-success">Hoạt động</span>' : '<span class="badge bg-danger">Bị khóa</span>' ?>
                                </td>
                                <td class="text-end">
                                    <?php if ($staff['id'] != $_SESSION['user']->getId()): ?>
                                        <?php if ($staff['status'] == 1): ?>
                                            <a href="index.php?act=toggle_user_status&id=<?= $staff['id'] ?>&status=1&return_to=admin_staff" class="btn btn-sm btn-outline-danger">Khóa</a>
                                        <?php else: ?>
                                            <a href="index.php?act=toggle_user_status&id=<?= $staff['id'] ?>&status=0&return_to=admin_staff" class="btn btn-sm btn-outline-success">Mở khóa</a>
                                        <?php endif; ?>
                                        <a href="index.php?act=delete_staff&id=<?= $staff['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Xóa nhân viên này?');">Xóa</a>
                                    <?php endif; ?>
                                </td>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Chưa có nhân viên nào.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>