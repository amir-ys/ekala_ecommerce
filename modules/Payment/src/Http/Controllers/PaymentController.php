<?php

namespace Modules\Payment\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Core\Responses\AjaxResponse;
use Modules\Payment\Contracts\PaymentRepositoryInterface;
use Modules\Payment\Models\Payment;

class PaymentController extends Controller
{
    private $paymentRepo;

    public function __construct(PaymentRepositoryInterface $paymentRepo,)
    {
        $this->paymentRepo = $paymentRepo;
    }

    public function index()
    {
        $this->authorize('view' , Payment::class);
        $payments = $this->paymentRepo->getAll();
        return view('Payment::payments.index', compact('payments'));
    }

    public function online()
    {
        $this->authorize('view' , Payment::class);
        $payments = $this->paymentRepo->getPaymentsByType(Payment::PAYMENT_TYPE_ONLINE);
        return view('Payment::payments.online', compact('payments'));
    }

    public function offline()
    {
        $this->authorize('view' , Payment::class);
        $payments = $this->paymentRepo->getPaymentsByType(Payment::PAYMENT_TYPE_OFFLINE);
        return view('Payment::payments.offline', compact('payments'));
    }

    public function destroy($paymentId)
    {
        $this->authorize('manage' , Payment::class);
        $payment = $this->paymentRepo->findById($paymentId);
        if (!$payment) {
            return AjaxResponse::error('پرداختی با این شناسه پیدا نشد.');
        }
        $this->paymentRepo->destroy($paymentId);
        return AjaxResponse::success("پرداخت با موفقیت حذف شد.");
    }
}
