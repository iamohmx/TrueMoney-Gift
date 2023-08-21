<?php 

require_once ('TrueMoney.php');
// Call a class to use

// 1
try {
    $mobile = "your_mobile_number";
    $voucher = "your_voucher_code";
    $result = Voucher::redeem($mobile, $voucher);
    print_r($result);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
// 2
// $use = Voucher::redeem("0930402402","");
// print_r($use);


?>