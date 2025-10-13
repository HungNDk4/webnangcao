<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');

// THÔNG TIN TEST CHUẨN TỪ VNPAY
$vnp_TmnCode = "CGZFS638"; //Mã website tại VNPAY 
$vnp_HashSecret = "JYYFFFPYZAQQRMOYSTATYWPREXBEJABD"; //Chuỗi bí mật

$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl = "http://localhost/webnangcao/controller/index.php?act=vnpay_return";
$vnp_apiUrl = "http://sandbox.vnpayment.vn/merchant_webapi/merchant.html";

// Các biến thời gian giữ nguyên
$startTime = date("YmdHis");
$expire = date('YmdHis', strtotime('+15 minutes', strtotime($startTime)));
