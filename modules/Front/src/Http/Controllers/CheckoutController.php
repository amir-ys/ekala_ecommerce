<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Cart\Facades\CartServiceFacade;
use Modules\Payment\Contracts\OrderRepositoryInterface;
use Modules\Payment\Facades\OrderServiceFacade;
use Modules\Product\Contracts\ProductRepositoryInterface;
use Modules\User\Contracts\UserRepositoryInterface;

class CheckoutController extends Controller
{
    public function addressPage()
    {
        $userAddresses = resolve(UserRepositoryInterface::class)->getActiveAddresses(auth()->id());
        return view('Front::checkout.save-address', compact('userAddresses'));
    }

    public function addressSave(): RedirectResponse
    {
        $this->validateInputs();

        $data = \request()->all();
        OrderServiceFacade::saveAddress(auth()->id() , $data);
        OrderServiceFacade::saveOrderAndOrderItems(auth()->id());

        $orderRepo = resolve(OrderRepositoryInterface::class);
        $orderRepo->removeAllBeforeCouponAmountInCurrentOrder(auth()->id());

        return redirect()->route('front.checkout.page');
    }

    public function checkoutPage()
    {
        $orderRepo = resolve(OrderRepositoryInterface::class);
        $order = $orderRepo->getCurrentOrder(auth()->id());
        return view('Front::checkout.checkout', compact('order'));
    }

    public function checkout(Request $request)
    {
        $valuesStatus = $this->checkForCorrectValues();
        if ($valuesStatus && $valuesStatus['status'] == -1){
            alert()->error('ناموفق' , $valuesStatus['message']);
            return  redirect()->route('front.cart.index');
        }

        $this->savePaymentTypeInSession($request->payment_type);
        $this->decrementProductQuantity();
        return redirect()->route('front.payment.pay');
    }

    public function savePaymentTypeInSession($paymentType)
    {
        session()->put(['payment_type' => $paymentType]);
    }

    public function checkForCorrectValues(): bool|array
    {
        $productRepository = resolve(ProductRepositoryInterface::class);

        foreach (CartServiceFacade::getItems() as $cartItem) {
            //check product exists or is marketable
            $product = $productRepository->findActiveById($cartItem->associatedModel->id);
            if (!$product){
                CartServiceFacade::clearAll();
                return [ 'status' => -1 , 'message' => 'محصول از فروشگاه حذف شده یا غیرقابل فروش شده است.'  ];
            }

            //check color attribute
            if ($color = $this->findColor($cartItem->associatedModel->id , $cartItem->attributes['color']['id'] )){
                $productQuantity = $color->quantity;
            }

            //check changes of price
            if ($cartItem->price !=  $product->priceWithAttributes($cartItem->attributes['color']['id'] , $cartItem->attributes['warranty']['id'] )){
                CartServiceFacade::clearAll();
                return [ 'status' => -1 , 'message' => 'قیمت محصولات تغییر پیدا کرده است.'  ];
            }

            //check changes of quantity
            if ($cartItem->quantity > $productQuantity){
                CartServiceFacade::clearAll();
                return [ 'status' => -1 , 'message' => 'موجودی محصولات تغییر پیدا کرده است.'  ];
            }
        }
        return false;
    }

    private function validateInputs()
    {
        $validated = Validator::make(\request()->all(),
            [
                'address_id' => ['required', 'exists:user_addresses,id'],
            ],
            [
                'address_id.required' => 'لطفا یک آدرس را وارد کنید.'
                ],
            [
                'address_id' => 'آدرس '
            ]);

        if ($validated->fails()) {
            if ($validated->errors()->has('address_id')) {
                alert()->warning('خطا', $validated->errors()->get('address_id'));
                back()->throwResponse();
            }
        }
    }

    public function decrementProductQuantity()
    {
        $productRepo = resolve(ProductRepositoryInterface::class);
        foreach (CartServiceFacade::getItems() as $cartItem) {
            $productRepo->decrementQuantity($cartItem->associatedModel->id, $cartItem->attributes['color']['id']);
        }
    }

    private function findColor($productId , $colorId)
    {
      return resolve( ProductRepositoryInterface::class)->findColorById($productId , $colorId , true);
    }

}
