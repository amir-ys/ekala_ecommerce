<?php


namespace Modules\Payment\Gateways\Zarinpal;


use Modules\Payment\Contracts\GatewayContract;
use Modules\Payment\Gateways\Gateway;

class ZarinpalAdaptor extends Gateway implements GatewayContract
{
    private $url;
    private $client;

    public function request($amount, $description = 'خرید کالا')
    {
        $this->client = new Zarinpal();
        $result = $this->client->request(config('payment.zarinpal.merchant'), $amount, $description,
            '', '', $this->callbackUrl(), true);
        if (isset($result["Status"]) && $result["Status"] == 100) {
            $this->url = $result['StartPay'];
            return $result['Authority'];
        } else {
            return [
                'status' => $result['Status'],
                'message' => $result['Message']
            ];
        }
    }

    public function verify($request, $amount)
    {
        $this->client = new Zarinpal();
        $result = $this->client->verify(config('payment.zarinpal.merchant'), $amount, true);

        if (isset($result["Status"]) && $result["Status"] == 100) {
            return $result["RefID"];
        } else {
            return [
                'status' => $result["Status"],
                'message' => $result["Message"]
            ];
        }
    }

    public function redirect()
    {
        $this->client->redirect($this->url);
    }

    public function getName()
    {
        return 'zarinpal';
    }

}
