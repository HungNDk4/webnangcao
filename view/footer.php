</main>
<footer class="footer">
    <div class="container">
        <div class="row g-4 py-4">
            <div class="col-12 col-md-12 col-lg-4">
                <div class="col-12 col-md-12 col-lg-4">
                    <h6 class="mb-4">Danh mục</h6>
                    <div class="row">
                        <?php
                        // Lấy danh mục động (đã được tải ở controller/index.php)
                        if (isset($danhmuc_for_menu) && !empty($danhmuc_for_menu)) {

                            // Giới hạn chỉ hiển thị 18 danh mục (9x2) để tránh vỡ layout
                            $limited_menu = array_slice($danhmuc_for_menu, 0, 18);

                            // Chia mảng danh mục thành 2 cột
                            $columns = array_chunk($limited_menu, ceil(count($limited_menu) / 2));

                            foreach ($columns as $column) {
                                echo '<div class="col-6">';
                                echo '<ul class="nav flex-column">';
                                foreach ($column as $dm) {
                                    // Link đến trang sản phẩm theo danh mục
                                    echo '<li class="nav-item mb-2"><a href="index.php?act=products_by_cat&id=' . $dm['id'] . '" class="nav-link">' . htmlspecialchars($dm['name']) . '</a></li>';
                                }
                                echo '</ul>';
                                echo '</div>';
                            }
                        } else {
                            // Fallback nếu không có danh mục
                            echo '<p>Chưa có danh mục sản phẩm.</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-8">
                <div class="row g-4">
                    <div class="col-6 col-sm-6 col-md-3">
                        <h6 class="mb-4">Về chúng tôi</h6>
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2"><a href="#!" class="nav-link">Công ty</a></li>
                            <li class="nav-item mb-2"><a href="#!" class="nav-link">Giới thiệu</a></li>
                            <li class="nav-item mb-2"><a href="#!" class="nav-link">Tin tức</a></li>
                            <li class="nav-item mb-2"><a href="#!" class="nav-link">Trung tâm hỗ trợ</a></li>
                            <li class="nav-item mb-2"><a href="#!" class="nav-link">Giá trị của chúng tôi</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-sm-6 col-md-3">
                        <h6 class="mb-4">Hỗ trợ khách hàng</h6>
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2"><a href="#!" class="nav-link">Thanh toán</a></li>
                            <li class="nav-item mb-2"><a href="#!" class="nav-link">Vận chuyển</a></li>
                            <li class="nav-item mb-2"><a href="#!" class="nav-link">Chính sách đổi trả</a></li>
                            <li class="nav-item mb-2"><a href="#!" class="nav-link">Câu hỏi thường gặp</a></li>
                            <li class="nav-item mb-2"><a href="#!" class="nav-link">Thanh toán</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-sm-6 col-md-3">
                        <h6 class="mb-4">Hợp tác</h6>
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2"><a href="#!" class="nav-link">Cơ hội đối tác</a></li>
                            <li class="nav-item mb-2"><a href="#!" class="nav-link">Trở thành đối tác</a></li>
                            <li class="nav-item mb-2"><a href="#!" class="nav-link">Thu nhập</a></li>
                            <li class="nav-item mb-2"><a href="#!" class="nav-link">Ý tưởng & Hướng dẫn</a></li>
                            <li class="nav-item mb-2"><a href="#!" class="nav-link">Đối tác bán lẻ</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-sm-6 col-md-3">
                        <h6 class="mb-4">Chương trình</h6>
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2"><a href="#!" class="nav-link">Chương trình liên kết</a></li>
                            <li class="nav-item mb-2"><a href="#!" class="nav-link">Thẻ quà tặng</a></li>
                            <li class="nav-item mb-2"><a href="#!" class="nav-link">Khuyến mãi & Giảm giá</a></li>
                            <li class="nav-item mb-2"><a href="#!" class="nav-link">Quảng cáo</a></li>
                            <li class="nav-item mb-2"><a href="#!" class="nav-link">Tuyển dụng</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-top py-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <span class="small text-muted">© 2025 Bản quyền thuộc về ní. Phát triển bởi Gemini.</span>
                </div>
                <div class="col-md-6">
                    <ul class="list-inline text-md-end mb-0 small text-muted">
                        <li class="list-inline-item"><a href="#!" class="text-reset">Điều khoản dịch vụ</a></li>
                        <li class="list-inline-item"><a href="#!" class="text-reset">Chính sách bảo mật</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="../assets/js/vendors/jquery.min.js"></script>
<script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/libs/simplebar/dist/simplebar.min.js"></script>
<script src="../assets/js/theme.min.js"></script>
<script src="../assets/libs/slick-carousel/slick/slick.min.js"></script>
<script src="../assets/js/vendors/slick-slider.js"></script>
<script src="../assets/libs/tiny-slider/dist/min/tiny-slider.js"></script>
<script src="../assets/js/vendors/tns-slider.js"></script>
<script src="../assets/js/vendors/zoom.js"></script>

</body>

<script>
    $(document).ready(function() {
        // Xử lý form đăng ký
        $('#register-form').on('submit', function(e) {
            e.preventDefault(); // Ngăn form gửi đi theo cách thông thường
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: 'index.php?act=xl_register',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        window.location.href = 'index.php?act=login';
                    } else {
                        $('#register-message').text(response.message).show();
                    }
                }
            });
        });

        // Xử lý form đăng nhập
        $('#login-form').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: 'index.php?act=xl_login',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        window.location.href = 'index.php'; // Chuyển về trang chủ
                    } else {
                        $('#login-message').text(response.message).show();
                    }
                }
            });
        });
    });
</script>

</html>