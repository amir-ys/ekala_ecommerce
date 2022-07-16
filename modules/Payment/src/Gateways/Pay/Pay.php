<?php

namespace Modules\Payment\Gateways\Pay;

class Pay
{

    private string $url;

    public function request($apiKey , $amount , $callbackUrl ,  $factorNumber ,  $mobile  ,$description )
    {
        $this->url = $callbackUrl;
        $result = $this->send($apiKey, $amount, $mobile, $factorNumber, $description);
        $result = json_decode($result);
        if($result->status) {
          return  [
              'status' => $result->status ,
              'token' => $result->token ,
              'startPay' =>  "https://pay.ir/pg/$result->token" ];
        } else {
            return [
                'status' => $result->status ,
               'errorMessage' =>  $result->errorMessage];
        }
    }

    private function send($api, $amount, $mobile = null, $factorNumber = null, $description = null) {
        return $this->curl_post('https://pay.ir/pg/send', [
            'api'          => $api,
            'amount'       => $amount,
            'redirect'     => $this->url,
            'mobile'       => $mobile,
            'factorNumber' => $factorNumber,
            'description'  => $description,
        ]);
    }

   public function verify($api) {
        $token = $_GET['token'];
        $result = json_decode($this->sendVerify($api,$token));
       return $result;
    }

    private function sendVerify($api , $token): bool|string
    {
        return $this->curl_post('https://pay.ir/pg/verify', [
            'api' 	=> $api,
            'token' => $token,
        ]);
    }



    public function redirect($url)
    {
        @header('Location: ' . $url);
        echo "<meta http-equiv='refresh' content='0; url={$url}' />";
        echo "<script>window.location.href = '{$url}';</script>";
        exit;
    }

    function curl_post($url, $params)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);
        $res = curl_exec($ch);
        curl_close($ch);

        return $res;
    }

}
