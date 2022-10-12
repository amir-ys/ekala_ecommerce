<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Front\Services\CartService;
use Modules\Payment\Contracts\OrderRepositoryInterface;
use Modules\Payment\Contracts\PaymentRepositoryInterface;
use Modules\Payment\Facades\PaymentServiceFacade;
use Modules\Payment\Models\Order;
use Modules\Payment\Models\Payment;
use Modules\Product\Contracts\ProductRepositoryInterface;

class PaymentController extends Controller
{
    protected $paymentRepo;
    protected $productRepo;
    protected $orderRepo;

    public function __construct(
        OrderRepositoryInterface   $orderRepo,
        PaymentRepositoryInterface $paymentRepo,
        ProductRepositoryInterface $productRepo)
    {
        $this->paymentRepo = $paymentRepo;
        $this->orderRepo = $orderRepo;
        $this->productRepo = $productRepo;
    }

    public function generate()
    {
        PaymentServiceFacade::generate();
        PaymentServiceFacade::redirect();
    }

    public function callback()
    {
        $payment = $this->checkTokenExistsInPayment();
        $result = PaymentServiceFacade::verify($payment->amount);

        if (is_array($result)) {
            $this->orderRepo->changeStatus($payment->order->id, Order::STATUS_FAILED);
            $this->paymentRepo->changeStatus($payment->id, Payment::STATUS_FAILED);
            $this->incrementProductQuantity();
            alert()->error('پرداخت ناموفق', 'سفارش شما انجام نشد.' . $result['message']);
        } else {
            $this->orderRepo->changeStatus($payment->order->id, Order::STATUS_PAID);
            $this->paymentRepo->changeStatus($payment->id, Payment::STATUS_SUCCESS);
            alert()->success('پرداخت موفق', 'سفارش شما باموفقیت انجام شد.');
        }
        CartService::clearAll();
        $this->clearPaymentTypeFromSession();
        return redirect()->route('front.home');
    }

    public function checkTokenExistsInPayment()
    {
        $token = $this->getTokenFromRequest();
        $payment = $this->paymentRepo->findByToken($token);
        if (!$payment) {
            alert()->error('ناموفق', 'سفارش شما انجام نشد');
            redirect()->route('front.home')->throwResponse();
        }
        return $payment;
    }

    private function getTokenFromRequest()
    {
        //todo
        $token = config('payment.'
            /* Cache::get('payment_method') . */
            . 'zarinpal' .
            '.callback_request_name');
        return request()->input($token);
    }

    public function clearPaymentTypeFromSession()
    {
        session()->forget('payment_type');
    }

    public function incrementProductQuantity()
    {
        $productRepo = resolve(ProductRepositoryInterface::class);
        foreach (CartService::getItems() as $cartItem) {
            $productRepo->incrementQuantity($cartItem->associatedModel->id, $cartItem->attributes['color']['id']);
        }
    }
}
