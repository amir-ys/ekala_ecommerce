<?php

namespace Modules\Payment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Modules\Payment\Contracts\OrderRepositoryInterface;
use Modules\Payment\Facades\PaymentService;
use Modules\Payment\Models\Order;

class OrderController extends Controller
{
    private $orderRepo;

    public function __construct(OrderRepositoryInterface $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    public function index()
    {
        $orders = $this->orderRepo->getAll();
        return view('Order::orders.index', compact('orders'));
    }

    public function show($orderId)
    {
        $order = $this->orderRepo->findById($orderId);
        return view('Order::orders.show', compact('order'));
    }

    public function details($orderId)
    {
        $order = $this->orderRepo->findById($orderId);
        $orderItems = $this->orderRepo->getItems($orderId);
        return view('Order::orders.items.index', compact('order' , 'orderItems'));
    }

    public function sending()
    {
        $orders = $this->orderRepo->getSending();
        return view('Order::orders.sending-index', compact('orders'));
    }

    public function unpaid()
    {
        $orders = $this->orderRepo->getUnpaid();
        return view('Order::orders.unpaid-index', compact('orders'));
    }

    public function canceled()
    {
        $orders = $this->orderRepo->getCanceled();
        return view('Order::orders.canceled-index', compact('orders'));
    }

    public function returned()
    {
        $orders = $this->orderRepo->getReturned();
        return view('Order::orders.returned-index', compact('orders'));
    }

    public function changeStatusPage($orderId)
    {
        $order = $this->orderRepo->findById($orderId);
        return view('Order::orders.change-status', compact('order'));
    }


    public function changeStatus(Request $request, $orderId)
    {
        Validator::validate($request->all(),
            [
                'status' => ['required', 'numeric', Rule::in(Order::$statuses)],
                'delivery_status' => ['required', 'numeric', Rule::in(Order::$deliveryStatuses)]
            ]
        );

        $this->orderRepo->changeStatus($orderId, $request->status);
        $this->orderRepo->changeDeliveryStatus($orderId, $request->delivery_status);
        return redirect()->route('panel.orders.index');
    }

}
