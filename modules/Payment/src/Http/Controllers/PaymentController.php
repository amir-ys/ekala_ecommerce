<?php

namespace Modules\Payment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Modules\Front\Services\CartService;
use Modules\Payment\Contracts\OrderRepositoryInterface;
use Modules\Payment\Contracts\PaymentRepositoryInterface;
use Modules\Payment\Gateways\Gateway;
use Modules\Payment\Models\Order;
use Modules\Payment\Models\Payment;
use Modules\Product\Contracts\ProductRepositoryInterface;

class PaymentController extends Controller
{
    private $paymentRepo;
    private OrderRepositoryInterface $orderRepo;
    private ProductRepositoryInterface $productRepo;

    public function __construct(OrderRepositoryInterface   $orderRepo,
                                PaymentRepositoryInterface $paymentRepo, ProductRepositoryInterface $productRepo)
    {
        $this->paymentRepo = $productRepo;
        $this->orderRepo = $orderRepo;
        $this->productRepo = $productRepo;
    }

    public function callback(Request $request)
    {
        $gateway = resolve(Gateway::class);
        $token = $this->getTokenFromRequest();
        $payment = $this->checkTokenExistsInPayment($token);
        $result = $gateway->verify($request, $payment->amount);

        if (is_array($result)) {
            $this->orderRepo->changeStatus($payment->order->id, Order::STATUS_FAILED);
            $this->paymentRepo->changeStatus($payment->id, Payment::STATUS_FAILED);
            alert()->error('پرداخت ناموفق', 'سفارش شما انجام نشد.' . $result['message']);
        } else {
            $this->orderRepo->changeStatus($payment->order->id, Order::STATUS_PAID);
            $this->paymentRepo->changeStatus($payment->id, Payment::STATUS_SUCCESS);
            $this->reduceProductQuantity();
            alert()->success('پرداخت موفق', 'سفارش شما باموفقیت انجام شد.');
        }
        CartService::clearAll();
        $this->clearPaymentMethodFromCache();
        return redirect()->route('front.home');
    }

    public function checkTokenExistsInPayment($token)
    {
        $payment = $this->paymentRepo->findByToken($token);
        if (!$payment) {
            alert()->error('ناموفق', 'سفارش شما انجام نشد');
            redirect()->route('front.home')->throwResponse();
        }
        return $payment;
    }

    private function clearPaymentMethodFromCache()
    {
        Cache::pull('payment_method');
    }

    private function getTokenFromRequest()
    {
        $token = config('payment.' . Cache::get('payment_method') . '.callback_request_name');
        return request()->input($token);
    }

    private function reduceProductQuantity()
    {
        foreach (CartService::getItems() as $cartItem) {
            $this->productRepo->reduceQuantity($cartItem->associatedModel->id, $cartItem->quantity);
        }
    }
}
