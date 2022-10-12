<?php
namespace Modules\Payment\Services\Payment;

use Modules\Payment\Contracts\OrderRepositoryInterface;
use Modules\Payment\Contracts\PaymentRepositoryInterface;
use Modules\Payment\Models\Payment;

class OfflinePaymentService
{
    public function generate()
    {
        $data = $this->getPaymentData();
        $payment = resolve(PaymentRepositoryInterface::class)->storePayment($data);
        resolve(OrderRepositoryInterface::class)->savePaymentId(auth()->id() , $payment->id);
        alert()->success('موفقیت آمیز'  ,  'پرداخت با موفقیت ثبت شد  و برای پرداخت مبلغ سفارش بزودی با شما تماس گرفته می شود.' );
        redirect()->route('front.home')->throwResponse();
    }

    public function getPaymentData()
    {
        $currentOrder = resolve(OrderRepositoryInterface::class)->getCurrentOrder(auth()->id());
        return [
            'user_id' =>  auth()->id() ,
            'amount' => $currentOrder->final_amount ,
            'order_id' => $currentOrder->id ,
            'pay_date' => null ,
            'payment_type' => Payment::PAYMENT_TYPE_OFFLINE ,
            'status' => Payment::STATUS_PENDING_APPROVAL ,
        ];
    }
}
