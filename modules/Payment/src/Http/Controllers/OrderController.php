<?php

namespace Modules\Payment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Modules\Payment\Contracts\OrderRepositoryInterface;
use Modules\Payment\Models\Order;
use Modules\Payment\Models\Payment;

class OrderController extends Controller
{
    private $orderRepo;

    public function __construct(OrderRepositoryInterface $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    public function index()
    {
        $this->authorize('view', Payment::class);
        $orders = $this->orderRepo->getAll();
        return view('Order::orders.index', compact('orders'));
    }

    public function show($orderId)
    {
        $this->authorize('view', Payment::class);
        $order = $this->orderRepo->findById($orderId);
        return view('Order::orders.show', compact('order'));
    }

    public function details($orderId)
    {
        $this->authorize('view', Payment::class);
        $order = $this->orderRepo->findById($orderId);
        $orderItems = $this->orderRepo->getItems($orderId);
        return view('Order::orders.items.index', compact('order', 'orderItems'));
    }

    public function sending()
    {
        $this->authorize('view', Payment::class);
        $orders = $this->orderRepo->getSending();
        return view('Order::orders.sending-index', compact('orders'));
    }

    public function unpaid()
    {
        $this->authorize('view', Payment::class);
        $orders = $this->orderRepo->getUnpaid();
        return view('Order::orders.unpaid-index', compact('orders'));
    }

    public function canceled()
    {
        $this->authorize('view', Payment::class);
        $orders = $this->orderRepo->getCanceled();
        return view('Order::orders.canceled-index', compact('orders'));
    }

    public function returned()
    {
        $this->authorize('view', Payment::class);
        $orders = $this->orderRepo->getReturned();
        return view('Order::orders.returned-index', compact('orders'));
    }

    public function changeStatusPage($orderId)
    {
        $this->authorize('manage', Payment::class);
        $order = $this->orderRepo->findById($orderId);
        return view('Order::orders.change-status', compact('order'));
    }


    public function changeStatus(Request $request, $orderId)
    {
        $this->authorize('manage', Payment::class);
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
