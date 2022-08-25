<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Core\Responses\AjaxResponse;
use Modules\Product\Contracts\DeliveryRepositoryInterface;
use Modules\Product\Http\Requests\DeliveryRequest;

class DeliveryController extends Controller
{
    private $deliveryRepo;

    public function __construct(DeliveryRepositoryInterface $deliveryRepository)
    {
        $this->deliveryRepo = $deliveryRepository;
    }

    public function index()
    {
        $delivery_methods = $this->deliveryRepo->getAll();
        return view('Product::delivery.index', compact('delivery_methods'));
    }

    public function create()
    {
        return view('Product::delivery.create');
    }

    public function store(DeliveryRequest $request)
    {
        $this->deliveryRepo->store($request->all());
        newFeedback();
        return redirect()->route('panel.delivery.index');
    }

    public function edit($deliveryId)
    {
        $delivery = $this->deliveryRepo->findById($deliveryId);
        return view('Product::delivery.edit', compact('delivery'));
    }

    public function update(DeliveryRequest $request, $deliveryId)
    {
        $this->deliveryRepo->update($deliveryId, $request->all());
        newFeedback();
        return redirect()->route('panel.delivery.index');
    }

    public function destroy($deliveryId)
    {
        $this->deliveryRepo->destroy($deliveryId);
        return AjaxResponse::success();
    }
}
