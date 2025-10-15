<div class="row">
    <div class="menu">

        <ul>
        </ul>

        <div class="search-container">
            <form action="index.php?act=search" method="post">
                <input type="text" name="keyword" placeholder="Tìm kiếm sản phẩm...">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>

        <ul>
            <li><a href="index.php">TRANG CHỦ</a></li>
            <li>
                <a href="index.php?act=hienthi_sp">SẢN PHẨM</a>
                <ul class="submenu">
                    <li><a href="index.php?act=hienthi_sp">Tất cả sản phẩm</a></li>
                    <?php
                    // Dùng biến $danhmuc_for_menu đã được tạo ở controller
                    if (isset($danhmuc_for_menu) && !empty($danhmuc_for_menu)) {
                        foreach ($danhmuc_for_menu as $dm) {
                            echo '<li><a href="index.php?act=products_by_cat&id=' . $dm['id'] . '">' . htmlspecialchars($dm['name']) . '</a></li>';
                        }
                    }
                    ?>
                </ul>
            </li>

            <li>
                <a href="index.php?act=view_cart">
                    <i class="fas fa-shopping-cart"></i> Giỏ Hàng
                    <?php
                    $cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
                    if ($cart_count > 0) {
                        echo "<span class='badge bg-danger ms-1'>{$cart_count}</span>";
                    }
                    ?>
                </a>
            </li>
            <?php if (isset($_SESSION['user'])): ?>
                <li>
                    <a href="#">XIN CHÀO, <?= $_SESSION['user']->getFullname() ?></a>
                    <ul class="submenu">
                        <li><a href="#">Thông tin tài khoản</a></li>
                        <li><a href="index.php?act=order_history">Lịch sử mua hàng</a></li>
                        <li><a href="index.php?act=logout">Đăng xuất</a></li>
                    </ul>
                </li>

                <?php if (isset($_SESSION['user']) && $_SESSION['user']->getRole() === 'admin'): ?>
                    <li>
                        <a href="#">QUẢN LÝ</a>
                        <ul class="submenu">

                            <li><a href="index.php?act=admin_dashboard">Thống kê</a></li>
                            <li><a href="index.php?act=admin_vouchers">Quản lí voucher</a></li>
                            <li><a href="index.php?act=hienthidm">Quản lý Danh mục</a></li>
                            <li><a href="index.php?act=hienthi_sp">Quản lý Sản phẩm</a></li>
                            <li><a href="index.php?act=admin_orders">Quản lý Đơn hàng</a></li>
                            <li><a href="index.php?act=admin_users">Quản lý Khách hàng</a></li>
                            <li><a href="index.php?act=admin_staff">Quản lý Nhân viên</a></li>
                            <li><a href="index.php?act=admin_reviews">Quản lí đánh giá</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

            <?php else: ?>
                <li><a href="index.php?act=login">ĐĂNG NHẬP</a></li>
                <li><a href="index.php?act=register">ĐĂNG KÝ</a></li>
            <?php endif; ?>
        </ul>
    </div>

</div>