<?php

class Voucher {
    public static function fetch($url, $options) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $options['method']);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('content-type: application/json'));
        if (isset($options['body'])) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($options['body']));
        }
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public static function redeem($mobile, $voucher) {
        $roundHash = array(10, 35);
        if ($mobile === "" || $voucher === "") {
            throw new Exception("Enter Mobile and Voucher");
        }
        if (strlen($mobile) !== $roundHash[0] || preg_match('/\D/', $mobile)) {
            throw new Exception("invaild_number_phone");
        }
        $hash = explode("v=", $voucher);
        $voucher_hash = preg_match('/[0-9A-Za-z]+/', ($hash[1] ?? $hash[0]), $matches);
        if ($roundHash[1] !== strlen($matches[0])) {
            throw new Exception("invaild_voucher");
        }
        $data = self::fetch(
            "https://gift.truemoney.com/campaign/vouchers/{$matches[0]}/redeem",
            array(
                'method' => "post",
                'headers' => array("content-type: application/json"),
                'body' => array("mobile" => $mobile, "voucher_hash" => $matches[0])
            )
        );
        $responseData = json_decode($data, true);
        if ($responseData['status']['message'] === "success") {
            return array(
                "status" => "success",
                "amount" => $responseData['data']['my_ticket']['amount_baht'],
                "hash" => $matches[0]
            );
        }
        throw new Exception($responseData['status']['message']);
    }
}

?>
