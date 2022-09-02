<?php

namespace Modules\Payment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Modules\Core\Responses\AjaxResponse;
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
                                PaymentRepositoryInterface $paymentRepo,
                                ProductRepositoryInterface $productRepo)
    {
        $this->paymentRepo = $paymentRepo;
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

    public function index()
    {
        $payments = $this->paymentRepo->getAll();
        return view('Payment::payments.index' , compact('payments'));
    }

    public function online()
    {
        $payments = $this->paymentRepo->getPaymentsByType(Payment::PAYMENT_TYPE_ONLINE);
        return view('Payment::payments.online' , compact('payments'));
    }

    public function offline()
    {
        $payments = $this->paymentRepo->getPaymentsByType(Payment::PAYMENT_TYPE_OFFLINE);
        return view('Payment::payments.offline' , compact('payments'));
    }

    public function cash()
    {
        $payments = $this->paymentRepo->getPaymentsByType(Payment::PAYMENT_TYPE_CASH);
        return view('Payment::payments.cash' , compact('payments'));
    }

    public function destroy($paymentId)
    {
        $payment = $this->paymentRepo->findById($paymentId);
        if (!$payment){
            return AjaxResponse::error('پرداختی با این شناسه پیدا نشد.');
        }
        $this->paymentRepo->destroy($paymentId);
        return AjaxResponse::success("پرداخت با موفقیت حذف شد.");
    }

    public function getPaymentOrders($paymentId)
    {
        $orders = $this->paymentRepo->getPaymentOrders($paymentId);
        return view('Payment::orders.index' , compact('orders'));
    }
}
