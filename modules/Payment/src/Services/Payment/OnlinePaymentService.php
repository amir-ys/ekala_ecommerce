<?php
namespace Modules\Payment\Services\Payment;

use Modules\Payment\Contracts\OrderRepositoryInterface;
use Modules\Payment\Contracts\PaymentRepositoryInterface;
use Modules\Payment\Gateways\Gateway;
use Modules\Payment\Models\Payment;

class OnlinePaymentService
{
    public function generate()
    {
        $data = $this->getPaymentData();
       $payment = resolve(PaymentRepositoryInterface::class)->storePayment($data);
        resolve(OrderRepositoryInterface::class)->savePaymentId(auth()->id() , $payment->id);
    }

    public function redirect()
    {
        return  resolve(Gateway::class)->redirect();

    }

    public function verify($amount)
    {
        resolve(Gateway::class)->verify(request(), $amount);
    }

    private function getPaymentData()
    {
        $currentOrder = resolve(OrderRepositoryInterface::class)->getCurrentOrder(auth()->id());
        $token = $this->getToken($currentOrder->final_amount);
        $gatewayName = $this->getGatewayName();
        return [
            'user_id' =>  auth()->id() ,
            'order_id' =>  $currentOrder->id ,
            'amount' => $currentOrder->final_amount ,
            'gateway_name' => $gatewayName ,
            'token' =>  $token ,
            'payment_type' => Payment::PAYMENT_TYPE_ONLINE ,
            'status' => Payment::STATUS_PENDING ,
        ];
    }

    private function getToken($amount)
    {
       return  resolve(Gateway::class)->request($amount);
    }

    private function getGatewayName()
    {
        return  resolve(Gateway::class)->getName();
    }

}
