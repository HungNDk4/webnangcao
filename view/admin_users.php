<div class="row">
    <div class="col-lg-12 col-md-12 col-12">
        <div class="border-bottom pb-4 mb-4 d-flex justify-content-between align-items-center">
            <div class="mb-3 mb-lg-0">
                <h1 class="mb-1 h2 fw-bold">Quản lý Khách hàng</h1>
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
                                <th>Tên khách hàng</th>
                                <th>Email</th>
                                <th>Hạng</th>
                                <th>Ngày tham gia</th>
                                <th>Trạng thái</th>
                                <th class="text-end">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($list_users) && !empty($list_users)): ?>
                                <?php foreach ($list_users as $user_item): ?>
                                    <tr>
                                        <td><?= $user_item['id'] ?></td>
                                        <td><?= htmlspecialchars($user_item['fullname']) ?></td>
                                        <td><?= htmlspecialchars($user_item['email']) ?></td>
                                        <td>
                                            <?php
                                            $rank = htmlspecialchars($user_item['rank']);
                                            $badge_rank = 'bg-secondary';
                                            if ($rank == 'silver') $badge_rank = 'bg-light-info text-dark-info';
                                            if ($rank == 'gold') $badge_rank = 'bg-warning';
                                            if ($rank == 'diamond') $badge_rank = 'bg-primary';
                                            echo "<span class='badge {$badge_rank}'>" . ucfirst($rank) . "</span>";
                                            ?>
                                        </td>
                                        <td><?= date('d/m/Y', strtotime($user_item['created_at'])) ?></td>
                                        <td>
                                            <?php if ($user_item['status'] == 'active'): ?>
                                                <span class="badge bg-success">Active</span>
                                            <?php else: ?>
                                                <span class="badge bg-danger">Locked</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-end">
                                            <?php if ($user_item['status'] == 'active'): ?>
                                                <a href="index.php?act=lock_user&id=<?= $user_item['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn khóa tài khoản này?');">Khóa</a>
                                            <?php else: ?>
                                                <a href="index.php?act=unlock_user&id=<?= $user_item['id'] ?>" class="btn btn-success btn-sm">Mở khóa</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">Chưa có khách hàng nào.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>