<?php
include_once "../controller/danhmuc.php";
include_once "../controller/sanpham.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class controller
{

    //San Pham
    public function hienthisanpham()
    {
        $sp = new sanpham();
        return $sp->getallsanpham();
    }
    public function themsp(sanpham $sp)
    {

        //goi them san pham trong class sanpham trong model
        $sp->themsp($sp);
    }
    public function xoasp($id)
    {
        $sp = new sanpham();
        $sp->setId($id);
        $sp->xoasp($sp);
    }
    public function motsp($id)
    {
        $sp = new sanpham();
        $sp->setId($id);
        return $sp->motsp($sp);
    }

    public function capnhatsp(sanpham $sp)
    {
        $sp->capnhatsp($sp);
    }


    //Danh Muc
    public function hienthidm()
    {
        $dm = new danhmuc();
        return $dm->getDS_Danhmuc();
    }
    public function xoadm($id)
    {
        $dm = new danhmuc();
        $dm->xoaDM($id);
    }
    public function themdm(danhmuc $dm)
    {

        //goi them danh muc trong class danhmuc trong model
        $dm->themDM($dm);
    }

    public function motdm($id)
    {
        $dm = new danhmuc();
        return $dm->motDM($id);
    }

    public function capnhatdm(danhmuc $dm)
    {
        $dm->capnhatDM($dm);
    }
    /**
     * Gửi email chào mừng đến người dùng mới.
     * @param string $userEmail Email của người nhận
     * @param string $userFullname Tên đầy đủ của người nhận
     */

    public function sendWelcomeEmail($userEmail, $userFullname)
    {
        $mail = new PHPMailer(true);

        try {
            // Cấu hình Server
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            // THAY THÔNG TIN CỦA BẠN VÀO ĐÂY
            $mail->Username   = 'hungninklon.game@gmail.com'; // <-- EMAIL GMAIL CỦA BẠN
            $mail->Password   = 'pfwg eanc qypv zkmj';    // <-- MẬT KHẨU ỨNG DỤNG
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;
            $mail->CharSet    = 'UTF-8';

            // Người gửi
            $mail->setFrom('thay.email.cua.ban.vao.day@gmail.com', 'Web Bán Hàng Nâng Cao'); // <-- EMAIL VÀ TÊN SHOP

            // Người nhận
            $mail->addAddress($userEmail, $userFullname);

            // Nội dung
            $mail->isHTML(true);
            $mail->Subject = 'Chào mừng bạn đến với Website của chúng tôi!';
            $mail->Body    = "Xin chào <b>{$userFullname}</b>,<br><br>Cảm ơn bạn đã đăng ký tài khoản tại website của chúng tôi. Chúc bạn có những trải nghiệm mua sắm tuyệt vời!";
            $mail->AltBody = "Xin chào {$userFullname},\nCảm ơn bạn đã đăng ký tài khoản tại website của chúng tôi.";

            $mail->send();
        } catch (Exception $e) {
            // Ghi lại lỗi nếu cần, ví dụ: error_log("Mailer Error: {$mail->ErrorInfo}");
            // Không nên echo lỗi ra cho người dùng thấy
        }
    }
    /*
     * Gửi email xác nhận đơn hàng.
     * @param string $userEmail Email người nhận
     * @param string $userFullname Tên người nhận
     * @param array $orderInfo Thông tin đơn hàng (từ session)
     * @param array $cart_items Các sản phẩm trong giỏ hàng
     */
    public function sendOrderConfirmationEmail($userEmail, $userFullname, $orderInfo, $cart_items)
    {
        $mail = new PHPMailer(true);

        // Tạo nội dung chi tiết đơn hàng cho email
        $item_details_html = '';
        foreach ($cart_items as $item) {
            $item_details_html .= '<tr>';
            $item_details_html .= '<td style="border:1px solid #ddd; padding:8px;">' . htmlspecialchars($item['name']) . '</td>';
            $item_details_html .= '<td style="border:1px solid #ddd; padding:8px; text-align:center;">' . $item['quantity'] . '</td>';
            $item_details_html .= '<td style="border:1px solid #ddd; padding:8px; text-align:right;">' . number_format($item['price']) . ' VNĐ</td>';
            $item_details_html .= '</tr>';
        }

        try {
            // Cấu hình Server (giữ nguyên của bạn)
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'hungninklon.game@gmail.com'; // <-- EMAIL GMAIL CỦA BẠN
            $mail->Password   = 'pfwg eanc qypv zkmj';    // <-- MẬT KHẨU ỨNG DỤNG
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;
            $mail->CharSet    = 'UTF-8';

            // Người gửi
            $mail->setFrom('contact@yourshop.com', 'Web Bán Hàng Nâng Cao'); // <-- THAY EMAIL VÀ TÊN SHOP

            // Người nhận
            $mail->addAddress($userEmail, $userFullname);

            // Nội dung Email
            $mail->isHTML(true);
            $mail->Subject = 'Xác nhận đơn hàng thành công!';
            $mail->Body    = "
                <h2>Cảm ơn bạn đã đặt hàng!</h2>
                <p>Xin chào <b>{$userFullname}</b>,</p>
                <p>Chúng tôi đã nhận được đơn hàng của bạn. Dưới đây là thông tin chi tiết:</p>
                
                <h3>Thông tin giao hàng</h3>
                <ul>
                    <li><b>Người nhận:</b> {$orderInfo['fullname']}</li>
                    <li><b>Email:</b> {$orderInfo['email']}</li>
                    <li><b>Điện thoại:</b> {$orderInfo['phone_number']}</li>
                    <li><b>Địa chỉ:</b> {$orderInfo['address']}</li>
                </ul>

                <h3>Chi tiết sản phẩm</h3>
                <table style='width:100%; border-collapse:collapse;'>
                    <thead>
                        <tr>
                            <th style='border:1px solid #ddd; padding:8px; background-color:#f2f2f2; text-align:left;'>Sản phẩm</th>
                            <th style='border:1px solid #ddd; padding:8px; background-color:#f2f2f2; text-align:center;'>Số lượng</th>
                            <th style='border:1px solid #ddd; padding:8px; background-color:#f2f2f2; text-align:right;'>Giá</th>
                        </tr>
                    </thead>
                    <tbody>
                        {$item_details_html}
                    </tbody>
                </table>
                <h3 style='text-align:right;'>Tổng cộng: <span style='color:red;'>" . number_format($orderInfo['total_money']) . " VNĐ</span></h3>
                <p>Chúng tôi sẽ xử lý và giao hàng cho bạn trong thời gian sớm nhất.</p>
                <p>Trân trọng,</p>
                <p><b>Web Bán Hàng Nâng Cao</b></p>
            ";
            $mail->AltBody = "Cảm ơn bạn đã đặt hàng. Tổng đơn hàng của bạn là " . number_format($orderInfo['total_money']) . " VNĐ.";

            $mail->send();
        } catch (Exception $e) {
            // Bạn có thể ghi log lỗi ở đây để debug, nhưng không hiển thị cho người dùng.
            // Ví dụ: error_log("Lỗi gửi mail xác nhận đơn hàng: {$mail->ErrorInfo}");
        }
    }
}
