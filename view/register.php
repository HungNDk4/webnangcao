<main class="container py-5">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Đăng Ký Tài Khoản</h4>
                </div>
                <div class="card-body">
                    <form action="index.php?act=xl_register" method="post">
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Họ và Tên</label>
                            <input type="text" name="fullname" class="form-control" id="fullname" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" name="password" class="form-control" id="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="repassword" class="form-label">Nhập Lại Mật khẩu</label>
                            <input type="password" name="repassword" class="form-control" id="repassword" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Đăng Ký</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>