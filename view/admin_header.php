<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>FreshCart Dashboard</title>

    <link href="../assets/libs/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link href="../assets/libs/feather-webfont/dist/feather-icons.css" rel="stylesheet" />
    <link href="../assets/libs/simplebar/dist/simplebar.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="../assets/css/theme.min.css" />
</head>

<body>
    <div class="main-wrapper">
        <nav class="navbar-vertical-nav d-none d-xl-block">
            <div class="navbar-vertical">
                <div class="px-4 py-5">
                    <a href="index.php" class="navbar-brand">
                        <img src="../assets/images/logo/freshcart-logo.svg" alt="" />
                    </a>
                </div>
                <div class="navbar-vertical-content flex-grow-1" data-simplebar="">
                    <ul class="navbar-nav flex-column" id="sideNavbar">
                        <li class="nav-item">
                            <a class="nav-link active" href="index.php?act=admin_dashboard">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><i class="bi bi-house"></i></span>
                                    <span class="nav-link-text">Dashboard</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item mt-2">
                            <a class="nav-link" href="index.php?act=admin_sanpham">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><i class="bi bi-cart"></i></span>
                                    <span class="nav-link-text">Sản phẩm</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item mt-2">
                            <a class="nav-link" href="index.php?act=admin_danhmuc">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><i class="bi bi-list-task"></i></span>
                                    <span class="nav-link-text">Danh mục</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item mt-2">
                            <a class="nav-link" href="index.php?act=admin_orders">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><i class="bi bi-bag"></i></span>
                                    <span class="nav-link-text">Đơn hàng</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item mt-2">
                            <a class="nav-link" href="index.php?act=admin_users">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><i class="bi bi-person"></i></span>
                                    <span class="nav-link-text">Khách hàng</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item mt-2">
                            <a class="nav-link" href="index.php?act=admin_vouchers">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-icon"><i class="bi bi-ticket-detailed"></i></span>
                                    <span class="nav-link-text">Vouchers</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <nav class="navbar-vertical-nav offcanvas offcanvas-start navbar-offcanvac" tabindex="-1" id="offcanvasExample">
        </nav>

        <main class="main-content-wrapper">
            <div class="container">