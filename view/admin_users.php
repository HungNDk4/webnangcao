<main class="container py-5">
    <h2 class="mb-4">Quản Lý Khách Hàng</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
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
                        <?php if (isset($list_users) && count($list_users) > 0): ?>
                            <?php foreach ($list_users as $user): ?>
                                <tr>
                                    <td><?= $user['id'] ?></td>
                                    <td><?= htmlspecialchars($user['fullname']) ?></td>
                                    <td><?= htmlspecialchars($user['email']) ?></td>
                                    <td><?= htmlspecialchars($user['role']) ?></td>
                                    <td class="text-center">
                                        <?php if ($user['status'] == 1): ?>
                                            <span class="badge bg-success">Hoạt động</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Bị khóa</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end">
                                        <?php if ($user['status'] == 1): ?>
                                            <a href="index.php?act=toggle_user_status&id=<?= $user['id'] ?>&status=1&return_to=admin_users" class="btn btn-sm btn-outline-danger" onclick="return confirm('...');">Khóa</a>
                                        <?php else: ?>
                                            <a href="index.php?act=toggle_user_status&id=<?= $user['id'] ?>&status=0&return_to=admin_users" class="btn btn-sm btn-outline-success" onclick="return confirm('...');">Mở khóa</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Chưa có người dùng nào.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>