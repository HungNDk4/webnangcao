<?php
// QUY TẮC 1: NẠP TẤT CẢ CÁC "BẢN THIẾT KẾ" (CLASS) TRƯỚC TIÊN
include_once '../model/xl_data.php';
include_once '../model/user.php';
include_once '../model/category.php';
include_once '../model/product.php';
include_once '../model/review.php';
include_once 'controller.php';
include_once '../model/order.php';
include_once '../model/voucher.php';
include_once '../model/statistic.php';
include_once './config_vnpay.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once '../PHPMailer/src/Exception.php';
require_once '../PHPMailer/src/PHPMailer.php';
require_once '../PHPMailer/src/SMTP.php';

// QUY TẮC 2: BẮT ĐẦU SESSION
session_start();

// === BẮT ĐẦU THÊM MỚI ===
// Lấy danh sách danh mục để hiển thị trên menu ở mọi trang
$cat_model_for_menu = new category();
$danhmuc_for_menu = $cat_model_for_menu->getAllCategories();
// QUY TẮC 3: HIỂN THỊ GIAO DIỆN
// include_once '../view/header.php';
// include_once '../view/menu.php';

// Khởi tạo giỏ hàng nếu chưa có
if (!isset($_SESSION["giohang"])) $_SESSION["giohang"] = [];

// Bật hiển thị lỗi để dễ dàng sửa code
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Lấy hành động từ URL
$act = $_REQUEST['act'] ?? 'trangchu';

// Dùng switch-case để điều hướng
switch ($act) {

    case 'trangchu':
    default:
        $prod_model = new product();
        // Lấy tất cả sản phẩm cho khu vực "Sản phẩm nổi bật"
        $danhsach = $prod_model->getAllProducts();

        // === THÊM MỚI: Lấy sản phẩm khuyến mãi ===
        $sanpham_khuyenmai = $prod_model->getSaleProducts(10); // Lấy 10 sản phẩm
        include '../view/header.php';
        include '../view/trangchu.php';
        break;

    case 'products_by_cat':
        if (isset($_GET['id'])) {
            $category_id = $_GET['id'];

            // Lấy tên danh mục để hiển thị tiêu đề
            $cat_model = new category();
            $category_info = $cat_model->getCategoryById($category_id);

            // Lấy danh sách sản phẩm thuộc danh mục đó
            $prod_model = new product();
            $danhsach = $prod_model->getProductsByCategoryId($category_id);
            include '../view/header.php';
            include '../view/products_by_cat.php';
        } else {
            // Nếu không có id, quay về trang chủ
            header('Location: index.php');
            exit();
        }
        break;
    // ============== USER ==============
    case 'register':
        include '../view/header.php';
        include '../view/register.php';
        break;
    case 'login':
        include '../view/header.php';
        include '../view/login.php';
        break;
    case 'logout':
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit();
    case 'xl_register':
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];
        if ($password !== $repassword) {
            echo "Mật khẩu không khớp!";
            break;
        }
        $user_model = new user();
        if ($user_model->checkEmailExists($email)) {
            echo "Email đã được đăng ký!";
            break;
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $newUser = new user();
        $newUser->setFullname($fullname);
        $newUser->setEmail($email);
        $newUser->setPassword($hashed_password);
        // ===== THÊM DÒNG NÀY =====
        $newUser->setRole('customer'); // Gán vai trò mặc định
        $user_model->addUser($newUser);
        $controller = new controller();
        $controller->sendWelcomeEmail($email, $fullname);
        echo "Đăng ký thành công! Vui lòng kiểm tra email của bạn.";
        break;
    case 'xl_login':
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user_model = new user();
        $user_obj = $user_model->getUserByEmail($email);
        if ($user_obj && password_verify($password, $user_obj->getPassword())) {
            $_SESSION['user'] = $user_obj;
            header('Location: index.php');
            exit();
        } else {
            echo "Email hoặc mật khẩu không đúng!";
        }
        break;

    // ============== CRUD DANH MỤC ==============
    case 'admin_danhmuc':
        $cat_model = new category();
        $danhmuc = $cat_model->getAllCategories();
        include '../view/admin_header.php';
        include '../view/admin_danhmuc.php'; // File này sẽ được cập nhật ở bước sau
        include '../view/admin_footer.php';
        break;
    case 'themdm':
        $newCat = new category();
        $newCat->setName($_POST['name']);
        $cat_model = new category();
        $cat_model->addCategory($newCat);
        header('Location: index.php?act=hienthidm');
        exit();
    case 'xoadm':
        $cat_model = new category();
        $cat_model->deleteCategory($_GET['id']);
        header('Location: index.php?act=hienthidm');
        exit();
    case 'editdm':
        $cat_model = new category();
        $danhmuc_edit = $cat_model->getCategoryById($_GET['id']);
        include '../view/header.php';
        include '../view/edit_danhmuc.php';
        break;
    case 'xl_editdm':
        $updatedCat = new category();
        $updatedCat->setId($_POST['id']);
        $updatedCat->setName($_POST['name']);
        $cat_model = new category();
        $cat_model->updateCategory($updatedCat);
        header('Location: index.php?act=hienthidm');
        exit();

        // ============== CRUD SẢN PHẨM ==============
    case "hienthi_sp":
        $cat_model = new category();
        $danhmuc = $cat_model->getAllCategories();
        $prod_model = new product();
        $danhsach = $prod_model->getAllProducts();
        include '../view/header.php';
        include '../view/shop.php';
        break;


    case "xl_themsp":
        $prod = new product();
        $prod->setName($_POST["name"]);
        $prod->setPrice($_POST["price"]);
        $prod->setQuantity($_POST["quantity"]);
        $prod->setDescription($_POST["description"]);
        $prod->setCategoryId($_POST['id_danhmuc']);
        // LẤY GIÁ TRỊ SALE_PRICE
        $prod->setSalePrice(empty($_POST["sale_price"]) ? NULL : $_POST["sale_price"]);
        $prod->setQuantity($_POST["quantity"]);
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $hinhsp = basename($_FILES['image']['name']);
            $prod->setImage($hinhsp);
            $target_dir = "../view/image/";
            move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $hinhsp);
        }
        $prod_model = new product();
        $prod_model->addProduct($prod);
        header('Location: index.php?act=hienthi_sp');
        exit();
    case "deletesp":
        $prod_model = new product();
        $prod_model->deleteProduct($_GET['id']);
        header('Location: index.php?act=hienthi_sp');
        exit();
    case 'editsp':
        $cat_model = new category();
        $danhmuc = $cat_model->getAllCategories();
        $prod_model = new product();
        $sanpham_edit = $prod_model->getProductById($_GET['id']);
        include '../view/header.php';
        include '../view/edit_sanpham.php';
        break;
    case 'xl_editsp':
        $prod = new product();
        $prod->setId($_POST["id"]);
        $prod->setName($_POST["name"]);
        $prod->setPrice($_POST["price"]);
        $prod->setQuantity($_POST["quantity"]);
        $prod->setDescription($_POST["description"]);
        $prod->setCategoryId($_POST['id_danhmuc']);
        $prod->setSalePrice(empty($_POST["sale_price"]) ? NULL : $_POST["sale_price"]);
        $prod->setQuantity($_POST["quantity"]);
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $hinhsp = basename($_FILES['image']['name']);
            $prod->setImage($hinhsp);
            $target_dir = "../view/image/";
            move_uploaded_file($_FILES['image']['tmp_name'], $target_dir . $hinhsp);
        } else {
            $prod->setImage($_POST["old_image"]);
        }
        $prod_model = new product();
        $prod_model->updateProduct($prod);
        header('Location: index.php?act=hienthi_sp');
        exit();

        // ============== GIỎ HÀNG ==============
    case 'view_cart':
        include '../view/header.php';
        include '../view/cart.php';
        break;
    case 'add_to_cart':
        // include_once '../view/header.php';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            // Sửa ở đây: Nếu sale_price không được gửi lên, mặc định nó bằng 0
            $sale_price = $_POST['sale_price'] ?? 0;
            $image = $_POST['image'];

            // Logic này giờ đây đã an toàn
            $final_price = ($sale_price > 0) ? $sale_price : $price;

            if (isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id]['quantity']++;
            } else {
                $_SESSION['cart'][$id] = [
                    'name' => $name,
                    'price' => $final_price,
                    'image' => $image,
                    'quantity' => 1
                ];
            }
        }
        // Chuyển hướng người dùng quay lại đúng trang họ vừa thao tác
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();



        /* ----- BẮT ĐẦU CODE MỚI ----- */
    case 'update_cart':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_sp = $_POST['id_sp'];
            $action = $_POST['action']; // 'increase' hoặc 'decrease'

            if (isset($_SESSION['cart'][$id_sp])) {
                if ($action == 'increase') {
                    $_SESSION['cart'][$id_sp]['quantity']++;
                } elseif ($action == 'decrease') {
                    $_SESSION['cart'][$id_sp]['quantity']--;
                    // Nếu số lượng giảm về 0, xóa sản phẩm khỏi giỏ hàng
                    if ($_SESSION['cart'][$id_sp]['quantity'] <= 0) {
                        unset($_SESSION['cart'][$id_sp]);
                    }
                }
            }
        }
        // Sau khi cập nhật, quay lại trang giỏ hàng
        header('Location: index.php?act=view_cart');
        exit();

    case 'remove_from_cart':
        if (isset($_GET['id']) && isset($_SESSION['cart'][$_GET['id']])) {
            unset($_SESSION['cart'][$_GET['id']]);
        }
        header('Location: index.php?act=view_cart');
        exit();

    case 'checkout':
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (isset($_SESSION['user'])) {
            // Nếu đã đăng nhập, chuyển đến trang thanh toán
            include '../view/header.php';
            include '../view/checkout.php';
        } else {
            // Nếu chưa, yêu cầu họ đăng nhập
            echo "<script>alert('Vui lòng đăng nhập để tiến hành thanh toán!');</script>";
            include '../view/header.php';
            include '../view/login.php';
        }
        break;
    case 'place_order':
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {

            // ===== BẮT ĐẦU KIỂM TRA TỒN KHO =====
            $prod_model_check = new product();
            $errors = [];
            foreach ($_SESSION['cart'] as $product_id => $item) {
                $product_in_db = $prod_model_check->getProductById($product_id);
                if ($product_in_db['quantity'] < $item['quantity']) {
                    // Nếu số lượng tồn kho ít hơn số lượng trong giỏ
                    $errors[] = "Sản phẩm '<b>" . htmlspecialchars($item['name']) . "</b>' chỉ còn " . $product_in_db['quantity'] . " sản phẩm. Vui lòng cập nhật lại giỏ hàng của bạn.";
                }
            }

            // Nếu có lỗi, quay lại giỏ hàng và thông báo
            if (!empty($errors)) {
                $_SESSION['cart_error'] = implode("<br>", $errors);
                session_write_close(); // Buộc máy chủ lưu session ngay lập tức
                header('Location: index.php?act=view_cart');
                exit();
            }
            // ===== KẾT THÚC KIỂM TRA TỒN KHO =====


            // Lấy thông tin (đoạn này giữ nguyên)
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $phone_number = $_POST['phone_number'];
            $address = $_POST['address'];
            $note = $_POST['note'];
            $user_id = $_SESSION['user']->getId();
            $payment_method = $_POST['payment_method'];

            // Tính lại tổng tiền cuối cùng một cách an toàn
            $total_money = 0;
            foreach ($_SESSION['cart'] as $item) {
                $total_money += $item['price'] * $item['quantity'];
            }
            $discount_amount = 0;
            if (isset($_SESSION['voucher'])) {
                $v = $_SESSION['voucher'];
                $discount_amount = ($v['discount_type'] == 'percent') ? ($total_money * $v['discount_value'] / 100) : $v['discount_value'];
            }
            $final_total = max(0, $total_money - $discount_amount);

            // Lưu thông tin đơn hàng vào session để tái sử dụng
            $_SESSION['order_info'] = [
                'user_id' => $user_id,
                'fullname' => $fullname,
                'email' => $email,
                'phone_number' => $phone_number,
                'address' => $address,
                'note' => $note,
                'total_money' => $final_total
            ];

            if ($payment_method == 'cod') {
                // XỬ LÝ THANH TOÁN COD
                $order_model = new order();
                $order_info = $_SESSION['order_info'];
                $cart_items_for_email = $_SESSION['cart']; // <-- Lấy thông tin giỏ hàng trước khi xóa

                $order_id = $order_model->createOrder(
                    $order_info['user_id'],
                    $order_info['fullname'],
                    $order_info['email'],
                    $order_info['phone_number'],
                    $order_info['address'],
                    $order_info['note'],
                    $order_info['total_money']
                );
                foreach ($_SESSION['cart'] as $product_id => $item) {
                    $order_model->addOrderDetail($order_id, $product_id, $item['quantity'], $item['price']);
                    $prod_model = new product();
                    $prod_model->updateProductQuantity($product_id, $item['quantity']);
                }

                // === BẮT ĐẦU THÊM MỚI ===
                // Gửi email xác nhận
                $controller = new controller();
                $controller->sendOrderConfirmationEmail(
                    $order_info['email'],
                    $order_info['fullname'],
                    $order_info,
                    $cart_items_for_email
                );
                // === KẾT THÚC THÊM MỚI ===

                unset($_SESSION['cart']);
                unset($_SESSION['voucher']);
                unset($_SESSION['order_info']);

                // Điều hướng đến trang thành công
                header('Location: index.php?act=order_success');
                exit();
            } elseif ($payment_method == 'vnpay') {
                // XỬ LÝ THANH TOÁN VNPAY (code VNPAY của cậu giữ nguyên)
                $vnp_TxnRef = time();
                $vnp_OrderInfo = 'Thanh toan don hang';
                $vnp_OrderType = 'billpayment';
                $vnp_Amount = $final_total * 100;
                $vnp_Locale = 'vn';
                $vnp_BankCode = 'NCB';
                $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
                if ($vnp_IpAddr == '::1') {
                    $vnp_IpAddr = '127.0.0.1';
                }

                $inputData = array(
                    "vnp_Version" => "2.1.0",
                    "vnp_TmnCode" => $vnp_TmnCode,
                    "vnp_Amount" => $vnp_Amount,
                    "vnp_Command" => "pay",
                    "vnp_CreateDate" => date('YmdHis'),
                    "vnp_CurrCode" => "VND",
                    "vnp_IpAddr" => $vnp_IpAddr,
                    "vnp_Locale" => $vnp_Locale,
                    "vnp_OrderInfo" => $vnp_OrderInfo,
                    "vnp_OrderType" => $vnp_OrderType,
                    "vnp_ReturnUrl" => $vnp_Returnurl,
                    "vnp_TxnRef" => $vnp_TxnRef
                );
                if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                    $inputData['vnp_BankCode'] = $vnp_BankCode;
                }
                ksort($inputData);
                $query = "";
                $i = 0;
                $hashdata = "";
                foreach ($inputData as $key => $value) {
                    if ($i == 1) {
                        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                    } else {
                        $hashdata .= urlencode($key) . "=" . urlencode($value);
                        $i = 1;
                    }
                    $query .= urlencode($key) . "=" . urlencode($value) . '&';
                }
                $vnp_Url = $vnp_Url . "?" . $query;
                $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;

                header('Location: ' . $vnp_Url);
                die();
            }
        }
        break;
    case 'vnpay_return':
        if (isset($_GET['vnp_ResponseCode']) && $_GET['vnp_ResponseCode'] == '00') {
            $order_model = new order();
            $order_info = $_SESSION['order_info'];
            $order_id = $order_model->createOrder(
                $order_info['user_id'],
                $order_info['fullname'],
                $order_info['email'],
                $order_info['phone_number'],
                $order_info['address'],
                $order_info['note'],
                $order_info['total_money']
            );
            foreach ($_SESSION['cart'] as $product_id => $item) {
                $order_model->addOrderDetail($order_id, $product_id, $item['quantity'], $item['price']);
            }
            unset($_SESSION['cart']);
            unset($_SESSION['voucher']);
            unset($_SESSION['order_info']);
            header('Location: index.php?act=order_success');
            exit();
        } else {
            unset($_SESSION['order_info']);
            echo "Thanh toán qua VNPAY thất bại hoặc đã bị hủy.";
        }
        break;

    // THÊM CASE MỚI ĐỂ HIỂN THỊ THÔNG BÁO
    case 'order_success':
        include '../view/header.php';
        include '../view/order_success.php';
        break;

    case 'order_history':
        // Luôn kiểm tra xem người dùng đã đăng nhập chưa
        if (isset($_SESSION['user'])) {
            $user_id = $_SESSION['user']->getId();

            $order_model = new order();
            $list_orders = $order_model->getOrdersByUserId($user_id);

            include '../view/header.php';
            include '../view/order_history.php';
        } else {
            // Nếu chưa đăng nhập, yêu cầu đăng nhập
            echo "<script>alert('Vui lòng đăng nhập để xem lịch sử mua hàng!');</script>";
            include '../view/header.php';
            include '../view/login.php';
        }
        break;
    case 'order_detail':
        if (isset($_SESSION['user']) && isset($_GET['id'])) {
            $order_id = $_GET['id'];
            $user_id = $_SESSION['user']->getId();

            $order_model = new order();
            // Lấy thông tin chung của đơn hàng
            $order_info = $order_model->getOrderById($order_id);

            // Kiểm tra xem đơn hàng này có đúng là của người dùng đang đăng nhập không
            if ($order_info && $order_info['user_id'] == $user_id) {
                // Lấy danh sách sản phẩm của đơn hàng
                $order_details = $order_model->getOrderDetailsByOrderId($order_id);
                include '../view/header.php';
                include '../view/order_detail.php';
            } else {
                // Nếu không phải, báo lỗi hoặc chuyển về trang lịch sử
                echo "Bạn không có quyền xem đơn hàng này!";
            }
        } else {
            header('Location: index.php?act=login');
            exit();
        }
        break;

    case 'cancel_order':
        // 1. Kiểm tra đăng nhập và sự tồn tại của ID đơn hàng
        if (isset($_SESSION['user']) && isset($_GET['id'])) {

            // 2. Lấy ID người dùng (từ session) và ID đơn hàng (từ URL)
            $user_id = $_SESSION['user']->getId();
            $order_id = $_GET['id'];

            // 3. Lấy thông tin đầy đủ của đơn hàng từ DB để kiểm tra
            $order_model = new order();
            $order_info = $order_model->getOrderById($order_id);

            // 4. KIỂM TRA QUYỀN SỞ HỮU VÀ TRẠNG THÁI
            // Đảm bảo đơn hàng tồn tại, ĐÚNG là của người này, VÀ đang ở trạng thái 'pending'
            if ($order_info && $order_info['user_id'] == $user_id && $order_info['status'] == 'pending') {

                // 5. Nếu tất cả đều đúng, thực hiện cập nhật
                $order_model->updateOrderStatus($order_id, 'cancelled');

                // 6. Quay về trang lịch sử
                header('Location: index.php?act=order_history');
                exit();
            } else {
                // Nếu không đúng, báo lỗi hoặc đơn giản là không làm gì cả
                echo "Hành động không được phép hoặc đơn hàng đã được xử lý.";
            }
        } else {
            // Nếu chưa đăng nhập, đá về trang login
            header('Location: index.php?act=login');
            exit();
        }
        break;





    // ============== QUẢN LÝ CỦA ADMIN ==============

    case 'admin_dashboard':
        if (isset($_SESSION['user']) && $_SESSION['user']->getRole() === 'admin') {
            $filter = $_GET['filter'] ?? 'all';
            $title = 'Thống kê tổng quan';
            $order_model = new order();
            $recent_orders = $order_model->getNewOrders(8); // Lấy 8 đơn hàng mới nhất
            // Tính toán khoảng ngày
            switch ($filter) {
                case 'today':
                    $start_date = date('Y-m-d 00:00:00');
                    $end_date = date('Y-m-d 23:59:59');
                    $title = 'Thống kê hôm nay';
                    break;
                case 'week':
                    $start_date = date('Y-m-d 00:00:00', strtotime('-6 days'));
                    $end_date = date('Y-m-d 23:59:59');
                    $title = 'Thống kê 7 ngày qua';
                    break;
                case 'month':
                    $start_date = date('Y-m-01 00:00:00');
                    $end_date = date('Y-m-t 23:59:59');
                    $title = 'Thống kê tháng này';
                    break;
                case 'year':
                    $start_date = date('Y-01-01 00:00:00');
                    $end_date = date('Y-12-31 23:59:59');
                    $title = 'Thống kê năm nay';
                    break;
                default:
                    $start_date = '2020-01-01 00:00:00';
                    $end_date = date('Y-m-d 23:59:59');
                    break;
            }

            $stat_model = new statistic();

            // GỌI ĐẦY ĐỦ CÁC HÀM, KHÔNG ĐƯỢC THIẾU
            $total_revenue = $stat_model->getTotalRevenue($start_date, $end_date);
            $total_orders = $stat_model->getTotalOrders($start_date, $end_date);
            $total_customers = $stat_model->getTotalCustomers($start_date, $end_date);
            $top_sell = $stat_model->getTopSellingProducts($start_date, $end_date);
            $least_sell = $stat_model->getLeastSellingProducts($start_date, $end_date); // Thêm dòng này
            $top_inventory = $stat_model->getTopInventoryProducts(); // Thêm dòng này

            include '../view/admin_header.php';
            include '../view/admin_dashboard.php';
            // include '../view/admin_footer.php';
        } else {
            echo "Bạn không có quyền truy cập!";
        }
        break;
    case 'admin_sanpham':
        if (isset($_SESSION['user']) && $_SESSION['user']->getRole() === 'admin') {
            $cat_model = new category();
            $danhmuc = $cat_model->getAllCategories();
            $prod_model = new product();
            $danhsach = $prod_model->getAllProducts();

            // THAY THẾ CÁC DÒNG INCLUDE CŨ
            include '../view/admin_header.php';
            // Sửa tên file view để tránh nhầm lẫn (bước sau)
            include '../view/admin_sanpham.php';
            include '../view/admin_footer.php';
        } else {
            echo "Bạn không có quyền truy cập!";
        }
        break;

    case 'admin_orders':
        // Kiểm tra xem có phải admin không
        if (isset($_SESSION['user']) && $_SESSION['user']->getRole() === 'admin') {
            $order_model = new order();
            $list_orders = $order_model->getAllOrders();
            include '../view/admin_header.php';
            include '../view/admin_orders.php'; // File này sẽ được cập nhật ở bước sau
            include '../view/admin_footer.php';
        } else {
            echo "Bạn không có quyền truy cập trang này!";
            // Hoặc chuyển hướng về trang chủ
            // header('Location: index.php');
        }
        break;

    case 'update_order_status':
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user']) && $_SESSION['user']->getRole() === 'admin') {
            $order_id = $_POST['order_id'];
            $status = $_POST['status'];

            $order_model = new order();
            $order_model->updateOrderStatus($order_id, $status);

            /* ----- BẮT ĐẦU CODE MỚI ----- */
            // Nếu trạng thái mới là 'completed', hãy cập nhật lại hạng cho khách hàng
            if ($status === 'completed') {
                // Lấy thông tin đơn hàng để biết user_id là ai
                $order_info = $order_model->getOrderById($order_id);
                if ($order_info) {
                    $user_id = $order_info['user_id'];
                    // Gọi hàm cập nhật hạng
                    $user_model = new user();
                    $user_model->updateUserRank($user_id);
                }
            }
            /* ----- KẾT THÚC CODE MỚI ----- */

            // Sau khi cập nhật, quay lại trang quản lý đơn hàng
            header('Location: index.php?act=admin_orders');
            exit();
        } else {
            // Nếu không phải admin hoặc không phải POST, không làm gì cả
            header('Location: index.php');
            exit();
        }
        break;

    case 'admin_users':
        if (isset($_SESSION['user']) && $_SESSION['user']->getRole() === 'admin') {
            $user_model = new user();
            // SỬA LẠI HÀM GỌI:
            $list_users = $user_model->getAllCustomers();
            include '../view/admin_header.php';
            include '../view/admin_users.php'; // File này sẽ được cập nhật ở bước sau
            include '../view/admin_footer.php';
        } else {
            echo "Bạn không có quyền truy cập trang này!";
        }
        break;
    case 'toggle_user_status':
        if (isset($_SESSION['user']) && $_SESSION['user']->getRole() === 'admin') {
            $user_id = $_GET['id'];
            $current_status = $_GET['status'];
            // Lấy trang cần quay về, mặc định là trang khách hàng
            $return_page = $_GET['return_to'] ?? 'admin_users';

            $new_status = $current_status == 1 ? 0 : 1;

            $user_model = new user();
            $user_model->updateUserStatus($user_id, $new_status);

            // Điều hướng về đúng trang đã yêu cầu
            header('Location: index.php?act=' . $return_page);
            exit();
        } else {
            header('Location: index.php');
            exit();
        }
        break;

    case 'admin_staff':
        if (isset($_SESSION['user']) && $_SESSION['user']->getRole() === 'admin') {
            $user_model = new user();
            $list_staff = $user_model->getAllStaff();
            include '../view/admin_header.php';
            include '../view/admin_staff.php'; // File này sẽ được cập nhật ở bước sau
            include '../view/admin_footer.php';
        } else {

            echo 'bạn không có quyền truy câp';
        }
        break;
    case 'xl_add_staff':
        if (isset($_SESSION['user']) && $_SESSION['user']->getRole() === 'admin') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $fullname = $_POST['fullname'];
            $role = $_POST['role'];

            $user_model = new user();
            if ($user_model->checkEmailExists($email)) {
                $_SESSION['error_message'] = "Lỗi: Email đã tồn tại!";
                header('Location: index.php?act=admin_staff');
                exit();
            }

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $newStaff = new user();
            $newStaff->setFullname($fullname);
            $newStaff->setEmail($email);
            $newStaff->setPassword($hashed_password);
            $newStaff->setRole($role); // Set vai trò được chọn từ form

            $user_model->addUser($newStaff);
            $_SESSION['success_message'] = "Đã thêm nhân viên thành công!";
            header('Location: index.php?act=admin_staff');
            exit();
        }
        break;

    case 'delete_staff':
        if (isset($_SESSION['user']) && $_SESSION['user']->getRole() === 'admin') {
            $staff_id = $_GET['id'];
            // Logic an toàn: Không cho admin tự xóa chính mình
            if ($staff_id == $_SESSION['user']->getId()) {
                $_SESSION['error_message'] = "Không thể tự xóa tài khoản của chính mình!";
            } else {
                $user_model = new user();
                $user_model->deleteUser($staff_id);
                $_SESSION['success_message'] = "Đã xóa nhân viên!";
            }
            header('Location: index.php?act=admin_staff');
            exit();
        }
        break;

    // ============== TÌM KIẾM SẢN PHẨM ==============
    case 'search':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $keyword = $_POST['keyword'];

            $prod_model = new product();
            $search_results = $prod_model->searchProducts($keyword);

            // Truyền từ khóa và kết quả ra view
            include '../view/header.php';
            include '../view/search_results.php';
        } else {
            // Nếu không phải tìm kiếm, quay về trang chủ
            header('Location: index.php');
            exit();
        }
        break;

    // ============== CHI TIẾT SẢN PHẨM & ĐÁNH GIÁ ==============
    case 'product_detail':
        if (isset($_GET['id'])) {
            $product_id = $_GET['id'];

            // Lấy thông tin sản phẩm
            $prod_model = new product();
            $product = $prod_model->getProductById($product_id);

            // Lấy danh sách đánh giá
            $review_model = new review();
            $reviews = $review_model->getReviewsByProductId($product_id);

            // ---- LOGIC KIỂM TRA QUYỀN ĐÁNH GIÁ ----
            $can_review = false; // Mặc định là không được đánh giá
            if (isset($_SESSION['user'])) {
                $user_id = $_SESSION['user']->getId();
                $order_model = new order();
                // Hỏi model xem người này đã mua sản phẩm chưa
                if ($order_model->hasUserPurchasedProduct($user_id, $product_id)) {
                    $can_review = true; // Nếu đã mua, cấp quyền
                }
            }
            // ---- KẾT THÚC LOGIC ----

            include '../view/header.php';
            include '../view/product_detail.php';
        } else {
            header('Location: index.php');
            exit();
        }
        break;

    // ============== QUẢN LÝ ĐÁNH GIÁ ==============
    case 'admin_reviews':
        if (isset($_SESSION['user']) && $_SESSION['user']->getRole() === 'admin') {
            $review_model = new review();
            $list_reviews = $review_model->getAllReviews();
            include '../view/header.php';
            include '../view/admin_reviews.php';
        } else {
            echo "Bạn không có quyền truy cập!";
        }
        break;

    case 'delete_review':
        if (isset($_SESSION['user']) && $_SESSION['user']->getRole() === 'admin') {
            $id = $_GET['id'];
            $review_model = new review();
            $review_model->deleteReview($id);
            header('Location: index.php?act=admin_reviews');
            exit();
        }
        break;


    case 'add_review':
        // Chỉ cho phép gửi khi đã đăng nhập và là phương thức POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user'])) {
            $product_id = $_POST['product_id'];
            $user_id = $_SESSION['user']->getId();
            $rating = $_POST['rating'];
            $comment = $_POST['comment'];

            $review_model = new review();
            $review_model->addReview($product_id, $user_id, $rating, $comment);

            // Sau khi gửi, quay lại đúng trang sản phẩm đó
            header('Location: index.php?act=product_detail&id=' . $product_id);
            exit();
        } else {
            // Nếu chưa đăng nhập, đá về trang đăng nhập
            header('Location: index.php?act=login');
            exit();
        }
        break;


    // ============== VOUCHER ==============

    case 'admin_vouchers':
        if (isset($_SESSION['user']) && $_SESSION['user']->getRole() === 'admin') {
            $voucher_model = new voucher();
            $list_vouchers = $voucher_model->getAllVouchers();
            include '../view/header.php';
            include '../view/admin_vouchers.php';
        } else {
            echo "Bạn không có quyền truy cập!";
        }
        break;



    case 'delete_voucher':
        if (isset($_SESSION['user']) && $_SESSION['user']->getRole() === 'admin') {
            $id = $_GET['id'];
            $voucher_model = new voucher();
            $voucher_model->deleteVoucher($id);
            header('Location: index.php?act=admin_vouchers');
            exit();
        }
        break;
    case 'apply_voucher':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $voucher_code = $_POST['voucher_code'];
            $voucher_model = new voucher();
            $voucher = $voucher_model->getVoucherByCode($voucher_code);

            if ($voucher) {
                // Nếu tìm thấy voucher hợp lệ, lưu vào session
                $_SESSION['voucher'] = $voucher;
            } else {
                // Nếu không, báo lỗi
                $_SESSION['voucher_message'] = "Mã giảm giá không hợp lệ hoặc đã hết hạn!";
                unset($_SESSION['voucher']); // Xóa voucher cũ nếu có
            }
        }
        header('Location: index.php?act=view_cart');
        exit();

    case 'remove_voucher':
        // Xóa voucher khỏi session
        unset($_SESSION['voucher']);
        header('Location: index.php?act=view_cart');
        exit();

    case 'xl_add_voucher':
        if (isset($_SESSION['user']) && $_SESSION['user']->getRole() === 'admin') {
            $code = $_POST['code'];

            $voucher_model = new voucher();

            // BƯỚC KIỂM TRA ĐƯỢC THÊM VÀO
            if ($voucher_model->checkCodeExists($code)) {
                // Nếu mã đã tồn tại, lưu lỗi vào session và quay lại
                $_SESSION['error_message'] = "Lỗi: Mã voucher '{$code}' đã tồn tại!";
                header('Location: index.php?act=admin_vouchers');
                exit();
            }

            // Nếu không trùng, tiếp tục thêm mới như cũ
            $v = new voucher();
            $v->setCode($code);
            $v->setDiscountValue($_POST['discount_value']);
            $v->setDiscountType($_POST['discount_type']);
            $v->setQuantity($_POST['quantity']);
            $v->setExpiresAt($_POST['expires_at']);

            $voucher_model->addVoucher($v);

            // Thêm thông báo thành công
            $_SESSION['success_message'] = "Đã thêm thành công voucher '{$code}'!";
            header('Location: index.php?act=admin_vouchers');
            exit();
        }
        break;
    case 'edit_voucher':
        if (isset($_SESSION['user']) && $_SESSION['user']->getRole() === 'admin') {
            $id = $_GET['id'];
            $voucher_model = new voucher();
            $voucher_edit = $voucher_model->getVoucherById($id);
            include '../view/header.php';
            include '../view/edit_voucher.php';
        } else {
            echo "Bạn không có quyền truy cập!";
        }
        break;

    case 'xl_edit_voucher':
        if (isset($_SESSION['user']) && $_SESSION['user']->getRole() === 'admin') {
            $v = new voucher();
            $v->setId($_POST['id']);
            $v->setCode($_POST['code']);
            $v->setDiscountValue($_POST['discount_value']);
            $v->setDiscountType($_POST['discount_type']);
            $v->setQuantity($_POST['quantity']);
            $v->setExpiresAt($_POST['expires_at']);

            $voucher_model = new voucher();
            $voucher_model->updateVoucher($v);

            $_SESSION['success_message'] = "Đã cập nhật thành công voucher '{$v->getCode()}'!";
            header('Location: index.php?act=admin_vouchers');
            exit();
        }
        break;
}
// Cuối cùng, hiển thị footer
// include_once '../view/footer.php';
