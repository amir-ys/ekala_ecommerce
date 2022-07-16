<?php

namespace Modules\Payment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Modules\Front\Services\CartService;
use Modules\Payment\Contracts\OrderRepositoryInterface;
use Modules\Payment\Contracts\TransactionRepositoryInterface;
use Modules\Payment\Gateways\Gateway;
use Modules\Payment\Models\Transaction;

class TransactionController extends Controller
{
    private TransactionRepositoryInterface $transactionRepo;
    private OrderRepositoryInterface $orderRepo;

    public function __construct(OrderRepositoryInterface $orderRepo, TransactionRepositoryInterface $transactionRepo)
    {
        $this->transactionRepo = $transactionRepo;
        $this->orderRepo = $orderRepo;
    }

    public function callback(Request $request)
    {
        $gateway = resolve(Gateway::class);
        $token = $this->getTokenFromRequest();
        $transaction = $this->checkTokenExistsInTransaction($token);
        $result = $gateway->verify($request, $transaction->amount);

        if (is_array($result)) {
            $this->orderRepo->changeStatus($transaction->order->id, Transaction::STATUS_FAILED);
            $this->transactionRepo->changeStatus($transaction->id, Transaction::STATUS_FAILED);
            alert()->error('پرداخت ناموفق', 'سفارش شما انجام نشد.' . $result['message']);
        } else {
            $this->orderRepo->changeStatus($transaction->order->id, Transaction::STATUS_SUCCESS);
            $this->transactionRepo->changeStatus($transaction->id, Transaction::STATUS_SUCCESS);
            alert()->success('پرداخت موفق', 'سفارش شما باموفقیت انجام شد.');
        }
        CartService::clearAll();
        $this->clearPaymentMethodFromCache();
        return redirect()->route('front.home');
    }

    public function checkTokenExistsInTransaction($token)
    {
        $transaction = $this->transactionRepo->findByToken($token);
        if (!$transaction) {
            alert()->error('ناموفق', 'سفارش شما انجام نشد');
            redirect()->route('front.home')->throwResponse();
        }
        return $transaction;
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
}


