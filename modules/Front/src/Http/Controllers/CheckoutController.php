<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Modules\Front\Http\Requests\saveAddressAndDeliveryRequest;
use Modules\Front\Services\CartService;
use Modules\Payment\Contracts\OrderRepositoryInterface;
use Modules\Product\Contracts\DeliveryRepositoryInterface;
use Modules\Product\Contracts\ProductRepositoryInterface;
use Modules\User\Contracts\UserRepositoryInterface;

class CheckoutController extends Controller
{
    public function addressAndDeliveryPage()
    {
        if ($this->cartIsEmpty()) {
            alert()->error('ناموفق', 'سبد خرید شما خالی است.');
            return back();
        }

        if (self::checkUserInfo()){
            return redirect()->route('front.checkout.profile.complete.page');
        }
        $userAddresses = resolve(UserRepositoryInterface::class)->getActiveAddresses(auth()->id());
        $deliveryMethods = resolve(DeliveryRepositoryInterface::class)->getActiveADelivery();
        return view('Front::checkout.checkout' , compact('userAddresses' , 'deliveryMethods'));
    }

    public function addressAndDeliverySave(SaveAddressAndDeliveryRequest $request)
    {
         resolve(OrderRepositoryInterface::class)->saveAddressAndDelivery(auth()->id() , $request->validated());
        return route('front.checkout.page');
    }

    public function checkoutPage(Request $request)
    {


    }

    public function checkout(Request $request)
    {
        if ($this->cartIsEmpty()) {
            alert()->error('ناموفق' , 'سبد خرید شما خالی است.');
            return back();
        }
        $valuesStatus = $this->checkForCorrectValues();
        if ($valuesStatus && $valuesStatus['status'] == -1){
            alert()->error('ناموفق' , $valuesStatus['message']);
            return  redirect()->route('front.cart.index');
        }
        $this->storePaymentMethodInCache($request->payment_method);
        return redirect()->route('panel.payment.pay');
    }

    private function cartIsEmpty()
    {
        return CartService::empty();
    }

    public function checkForCorrectValues()
    {
        $productRepository = resolve(ProductRepositoryInterface::class);
        foreach (CartService::getItems() as $cartItem) {
            $product = $productRepository->findById($cartItem->id);
            if ($product && ($cartItem->price != $product->finalPrice() )){
                CartService::clearAll();
                return [ 'status' => -1 , 'message' => 'قیمت محصولات تغییر پیدا کرده است.'  ];
            }

            if ($product && ($cartItem->quantity > $product->quantity )){
                CartService::clearAll();
                return [ 'status' => -1 , 'message' => 'موجودی محصولات تغییر پیدا کرده است.'  ];
            }
        }
    }

    private function storePaymentMethodInCache($paymentMethod)
    {
        Cache::put('payment_method' , $paymentMethod);
    }

    public static function checkUserInfo()
    {
        if (empty(auth()->user()->first_name)
            || empty(auth()->user()->last_name)
            || empty(auth()->user()->mobile)
            || empty(auth()->user()->email)
        ){
           return true;
        }
    }

}
