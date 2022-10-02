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
        resolve(PaymentRepositoryInterface::class)->storeOfflinePayment($data);
        alert()->success('موفقیت آمیز'  ,  'پرداخت با موفقیت ثبت شد  و برای پرداخت مبلغ سفارش بزودی با شما تماس گرفته می شود.' );
        redirect()->route('home')->throwResponse();
    }

    public function getPaymentData()
    {
        $currentOrder =   resolve(OrderRepositoryInterface::class)->getCurrentOrder(auth()->id());
        return [
            'user_id' =>  auth()->id() ,
            'amount' => $currentOrder->final_amount ,
            'pay_date' => null ,
            'payment_type' => Payment::PAYMENT_TYPE_OFFLINE ,
            'status' => Payment::STATUS_PENDING_APPROVAL ,
        ];
    }
}
