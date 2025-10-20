<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta content="" name="author" />
    <meta name="keywords" content="" />
    <link href="../assets/libs/slick-carousel/slick/slick.css" rel="stylesheet" />
    <link href="../assets/libs/slick-carousel/slick/slick-theme.css" rel="stylesheet" />
    <link href="../assets/libs/tiny-slider/dist/tiny-slider.css" rel="stylesheet" />
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/favicon/favicon.ico" />

    <link href="../assets/libs/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="../assets/libs/feather-webfont/dist/feather-icons.css" rel="stylesheet">
    <link href="../assets/libs/simplebar/dist/simplebar.min.css" rel="stylesheet">


    <link rel="stylesheet" href="../assets/css/theme.min.css">
    <title>FreshCart - eCommerce HTML Template</title>
</head>

<body>
    <header>
        <div class="py-2" style="background-color: #f0f3f2;">
            <div class="container">
                <div class="row w-100 align-items-center gx-lg-2 gx-0">
                    <div class="col-xxl-2 col-lg-3 col-md-6 col-5">
                        <a class="navbar-brand d-none d-lg-block" href="index.php">
                            <img src="../assets/images/logo/freshcart-logo.svg" alt="eCommerce HTML Template" />
                        </a>
                        <div class="d-flex justify-content-between w-100 d-lg-none">
                            <a class="navbar-brand" href="index.php">
                                <img src="../assets/images/logo/freshcart-logo.svg" alt="eCommerce HTML Template" />
                            </a>
                        </div>
                    </div>
                    <div class="col-xxl-5 col-lg-5 d-none d-lg-block">
                        <form action="index.php?act=search" method="post">
                            <div class="input-group">
                                <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm sản phẩm...">
                                <button class="btn btn-dark" type="submit"><i class="feather-icon icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4 col-xxl-5 text-end col-md-6 col-7">
                        <div class="list-inline">
                            <div class="list-inline-item me-5 d-none d-lg-block">
                                <a href="#" class="text-muted">
                                </a>
                            </div>
                            <div class="list-inline-item me-5">
                                <a href="#!" class="text-muted" data-bs-toggle="modal" data-bs-target="#userModal">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="20"
                                        height="20"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </a>
                            </div>
                            <div class="list-inline-item me-5 me-lg-0">
                                <a class="text-muted position-relative" href="index.php?act=view_cart">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="20"
                                        height="20"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="feather feather-shopping-bag">
                                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                        <line x1="3" y1="6" x2="21" y2="6"></line>
                                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                                    </svg>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                        <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
                                    </span>
                                </a>
                            </div>
                            <div class="list-inline-item d-inline-block d-lg-none">
                                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false" aria-label="Toggle navigation">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-text-indent-left text-primary" viewBox="0 0 16 16">
                                        <path d="M2 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm.646 2.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L4.293 8 2.646 6.354a.5.5 0 0 1 0-.708zM7 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <nav class="navbar navbar-expand-lg navbar-light navbar-default py-0 pb-lg-4" aria-label="Offcanvas navbar large">
                <div class="container">
                    <div class="offcanvas offcanvas-start" tabindex="-1" id="navbar-default" aria-labelledby="navbar-defaultLabel">
                        <div class="offcanvas-header pb-1">
                            <a href="index.php"><img src="../assets/images/logo/freshcart-logo.svg" alt="eCommerce HTML Template" /></a>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <div class="d-block d-lg-none mb-4">
                                <form action="#">
                                    <div class="input-group">
                                        <input class="form-control rounded" type="search" placeholder="Search for products" />
                                        <span class="input-group-append">
                                            <button class="btn bg-white border border-start-0 ms-n10 rounded-0 rounded-end" type="button">
                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    width="16"
                                                    height="16"
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    class="feather feather-search">
                                                    <circle cx="11" cy="11" r="8"></circle>
                                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                                </svg>
                                            </button>
                                        </span>
                                    </div>
                                </form>
                                <div class="mt-2">
                                    <button type="button" class="btn btn-outline-gray-400 text-muted w-100" data-bs-toggle="modal" data-bs-target="#locationModal">
                                        <i class="feather-icon icon-map-pin me-2"></i>
                                        Pick Location
                                    </button>
                                </div>
                            </div>

                            <ul class="navbar-nav align-items-center">
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php">Trang chủ</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a
                                        class="nav-link dropdown-toggle"
                                        href="#"
                                        role="button"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        Sản phẩm
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="index.php?act=hienthi_sp">Tất cả sản phẩm</a></li>
                                        <?php
                                        if (isset($danhmuc_for_menu) && !empty($danhmuc_for_menu)) {
                                            foreach ($danhmuc_for_menu as $dm) {
                                                echo '<li><a class="dropdown-item" href="index.php?act=products_by_cat&id=' . $dm['id'] . '">' . htmlspecialchars($dm['name']) . '</a></li>';
                                            }
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a
                                        class="nav-link dropdown-toggle"
                                        href="#"
                                        role="button"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        Tài khoản
                                    </a>
                                    <ul class="dropdown-menu">
                                        <?php if (isset($_SESSION['user'])): ?>
                                            <li><a class="dropdown-item" href="#">Thông tin tài khoản</a></li>
                                            <li><a class="dropdown-item" href="index.php?act=order_history">Lịch sử mua hàng</a></li>
                                            <li>
                                                <hr class="dropdown-divider" />
                                            </li>
                                            <li><a class="dropdown-item" href="index.php?act=logout">Đăng xuất</a></li>
                                        <?php else: ?>
                                            <li><a class="dropdown-item" href="index.php?act=login">Đăng nhập</a></li>
                                            <li><a class="dropdown-item" href="index.php?act=register">Đăng ký</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                                <?php if (isset($_SESSION['user']) && $_SESSION['user']->getRole() === 'admin'): ?>
                                    <li class="nav-item dropdown">
                                        <a
                                            class="nav-link dropdown-toggle"
                                            href="#"
                                            role="button"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            Quản lý
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="index.php?act=admin_dashboard">Thống kê</a></li>
                                            <li><a class="dropdown-item" href="index.php?act=hienthidm">Quản lý Danh mục</a></li>
                                            <li><a class="dropdown-item" href="index.php?act=admin_products">Quản lý Sản phẩm</a></li>
                                            <li><a class="dropdown-item" href="index.php?act=admin_orders">Quản lý Đơn hàng</a></li>
                                            <li><a class="dropdown-item" href="index.php?act=admin_users">Quản lý Khách hàng</a></li>
                                            <li><a class="dropdown-item" href="index.php?act=admin_staff">Quản lý Nhân viên</a></li>
                                            <li><a class="dropdown-item" href="index.php?act=admin_vouchers">Quản lí voucher</a></li>
                                            <li><a class="dropdown-item" href="index.php?act=admin_reviews">Quản lí đánh giá</a></li>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
    </header>
    <main>