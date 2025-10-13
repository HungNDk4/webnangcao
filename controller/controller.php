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
}
