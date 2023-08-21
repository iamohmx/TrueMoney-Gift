# TrueMoney-Gift

#usage

```php
require_once ('TrueMoney.php');
try {
    $mobile = "your_mobile_number";
    $voucher = "your_voucher_code";
    $result = Voucher::redeem($mobile, $voucher);
    print_r($result);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
```

# API Reference
| Parameter | Type | Description |
| --- | --- | --- | 
| `mobile` | `string` | ส่วนของเบอร์วอเลตผู้รับเงิน **Required** |
| `voucher` | `string` | ส่วนของลิ้งค์อั่งเปา หรือจะใช้ โค้ตอั่งเปาก็ได้ **Required** |
