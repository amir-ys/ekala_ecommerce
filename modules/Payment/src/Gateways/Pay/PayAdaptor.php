<?php

namespace Modules\Payment\Gateways\Pay;


use Modules\Payment\Contracts\GatewayContract;
use Modules\Payment\Gateways\Gateway;

class PayAdaptor extends Gateway implements GatewayContract
{
    public $url ;
    public $client ;
    public function request($amount , $description)
    {
        $this->client = new Pay();
        $result  = $this->client->request(config('payment.pay.merchant') , $amount ,
            $this->callbackUrl() , '' , '' ,$description  );
        if (isset($result["status"]) && $result["status"] == 1) {
            $this->url = $result['startPay'];
            return $result['token'];
        } else {
            return [
                'status' => $result['status'],
                'message' => $result['errorMessage']
            ];
        }
    }

    public function verify($request , $payment)
    {
        $this->client = new Pay();
        $result = $this->client->verify(config('payment_method.pay.merchant'));
        if(isset($result->status)){
            if($result->status == 1){
                return  $result->transId;
            }
        } else {
            if($_GET['status'] == 0){
                return  [
                    'status' => 0 ,
                    'message' => 'تراکنش با خطا مواجه شد'
                ];
            }
        }
    }

    public function redirect()
    {
        $this->client->redirect($this->url);
    }

    public function getName()
    {
        return 'pay';
    }
}
