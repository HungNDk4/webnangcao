<div class="row">
    <div class="col-lg-12 col-md-12 col-12">
        <div class="border-bottom pb-4 mb-4 d-flex justify-content-between align-items-center">
            <div class="mb-3 mb-lg-0">
                <h1 class="mb-1 h2 fw-bold">Quản lý Nhân viên</h1>
                <form method="POST" action="index.php?act=admin_users">
                    <div class="input-group">
                        <input type="text" name="search_query" class="form-control" placeholder="Tìm theo tên hoặc email..."
                            value="<?= htmlspecialchars($search_keyword) // Giữ lại từ khóa đã tìm 
                                    ?>">
                        <button type="submit" name="search_submit" class="btn btn-outline-secondary">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
            <div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover text-nowrap">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Tên nhân viên</th>
                                <th>Email</th>
                                <th>Ngày tham gia</th>
                                <th>Trạng thái</th>
                                <th class="text-end">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($list_staff) && !empty($list_staff)): ?>
                                <?php foreach ($list_staff as $staff_member): ?>
                                    <tr>
                                        <td><?= $staff_member['id'] ?></td>
                                        <td><?= htmlspecialchars($staff_member['fullname']) ?></td>
                                        <td><?= htmlspecialchars($staff_member['email']) ?></td>
                                        <td><?= date('d/m/Y', strtotime($staff_member['created_at'])) ?></td>
                                        <td>
                                            <?php if ($staff_member['status'] == 'active'): ?>
                                                <span class="badge bg-success">Active</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Locked</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-end">
                                            <?php if ($staff_member['status'] == 'active'): ?>
                                                <a href="index.php?act=lock_user&id=<?= $staff_member['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn khóa tài khoản này?');">Khóa</a>
                                            <?php else: ?>
                                                <a href="index.php?act=unlock_user&id=<?= $staff_member['id'] ?>" class="btn btn-success btn-sm">Mở khóa</a>
                                            <?php endif; ?>
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
        </div>
    </div>
</div>