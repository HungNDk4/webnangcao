<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Admin Dashboard</title>
    <link href="../assets/libs/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link href="../assets/libs/feather-webfont/dist/feather-icons.css" rel="stylesheet" />
    <link href="../assets/libs/simplebar/dist/simplebar.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/theme.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>

<body>
    <div class="main-wrapper">
        <nav class="navbar-vertical-nav d-none d-xl-block">
            <div class="navbar-vertical">
                <div class="px-4 py-5">
                    <a href="index.php" class="navbar-brand">
                        <img src="../assets/images/logo/freshcart-logo.svg" alt="FreshCart Logo" />
                    </a>
                </div>
                <div class="navbar-vertical-content flex-grow-1" data-simplebar="">
                    <ul class="navbar-nav flex-column" id="sideNavbar">
                        <li class="nav-item">
                            <a class="nav-link <?= ($act == 'admin_dashboard') ? 'active' : '' ?>" href="index.php?act=admin_dashboard">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa-solid fa-chart-pie"></i></span><span class="nav-link-text">Thống kê</span></div>
                            </a>
                        </li>
                        <li class="nav-item mt-6 mb-3"><span class="nav-label">Quản lý Cửa hàng</span></li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($act == 'admin_products') ? 'active' : '' ?>" href="index.php?act=admin_sanpham">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa-solid fa-cart-shopping"></i></span><span class="nav-link-text">Sản phẩm</span></div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($act == 'admin_danhmuc') ? 'active' : '' ?>" href="index.php?act=admin_danhmuc">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa-solid fa-list"></i></span><span class="nav-link-text">Danh mục</span></div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($act == 'admin_orders') ? 'active' : '' ?>" href="index.php?act=admin_orders">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa-solid fa-box"></i></span><span class="nav-link-text">Đơn hàng</span></div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($act == 'admin_vouchers') ? 'active' : '' ?>" href="index.php?act=admin_vouchers">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa-solid fa-ticket"></i></span><span class="nav-link-text">Vouchers</span></div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($act == 'admin_reviews') ? 'active' : '' ?>" href="index.php?act=admin_reviews">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa-solid fa-star"></i></span><span class="nav-link-text">Đánh giá</span></div>
                            </a>
                        </li>
                        <li class="nav-item mt-6 mb-3"><span class="nav-label">Quản lý Người dùng</span></li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($act == 'admin_users') ? 'active' : '' ?>" href="index.php?act=admin_users">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa-solid fa-user"></i></span><span class="nav-link-text">Khách hàng</span></div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($act == 'admin_staff') ? 'active' : '' ?>" href="index.php?act=admin_staff">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><i class="fa-solid fa-user-tie"></i></span><span class="nav-link-text">Nhân viên</span></div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="main-content-wrapper">
            <div class="container">