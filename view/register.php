<section class="my-lg-14 my-8">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-6 col-lg-4 order-lg-1 order-2">
                <img src="../assets/images/svg-graphics/signup-g.svg" alt="" class="img-fluid">
            </div>
            <div class="col-12 col-md-6 offset-lg-1 col-lg-4 order-lg-2 order-1">
                <div class="mb-lg-9 mb-5">
                    <h1 class="mb-1 h2 fw-bold">Tạo tài khoản mới</h1>
                    <p>Đã có tài khoản? <a href="index.php?act=login">Đăng nhập</a></p>
                </div>
                <form action="index.php?act=xl_register" method="post">
                    <div class="row g-3">
                        <div class="col-12">
                            <input type="text" class="form-control" name="fullname" placeholder="Họ và tên" required>
                        </div>
                        <div class="col-12">
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                        <div class="col-12">
                            <input type="password" class="form-control" name="password" placeholder="Mật khẩu" required>
                        </div>
                        <div class="col-12">
                            <input type="password" class="form-control" name="repassword" placeholder="Nhập lại mật khẩu" required>
                        </div>
                        <div class="col-12 d-grid">
                            <button type="submit" class="btn btn-primary">Đăng ký</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>