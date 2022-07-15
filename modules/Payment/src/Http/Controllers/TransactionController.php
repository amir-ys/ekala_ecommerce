<?php

namespace Modules\Payment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $token = $request->input('Authority');
        $transaction = $this->checkTokenExistsInTransaction($token);
        $result = $gateway->verify($request, $transaction->amount);


        if (is_array($result)) {
            CartService::clearAll();
            $this->orderRepo->changeStatus($transaction->order->id, Transaction::STATUS_FAILED);
            $this->transactionRepo->changeStatus($transaction->id, Transaction::STATUS_FAILED);
            alert()->error('پرداخت ناموفق',  'سفارش شما انجام نشد.' .  $result['message'] );
        } else {
            CartService::clearAll();
            $this->orderRepo->changeStatus($transaction->order->id, Transaction::STATUS_SUCCESS);
            $this->transactionRepo->changeStatus($transaction->id, Transaction::STATUS_SUCCESS);
            alert()->success('پرداخت موفق', 'سفارش شما باموفقیت انجام شد.');
        }
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
}
