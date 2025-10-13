<main class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><?= $title ?? 'Bảng Điều Khiển' ?></h2>
        <div>
            <a href="index.php?act=admin_dashboard&filter=today" class="btn btn-outline-secondary">Hôm nay</a>
            <a href="index.php?act=admin_dashboard&filter=week" class="btn btn-outline-secondary">7 ngày</a>
            <a href="index.php?act=admin_dashboard&filter=month" class="btn btn-outline-secondary">Tháng này</a>
            <a href="index.php?act=admin_dashboard&filter=year" class="btn btn-outline-secondary">Năm nay</a>
            <a href="index.php?act=admin_dashboard&filter=all" class="btn btn-outline-secondary">Tất cả</a>
        </div>
    </div>

    <div class="row">
    </div>

    <hr class="my-5">

    <div class="row">
    </div>
</main>