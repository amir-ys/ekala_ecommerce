<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Modules\Front\Services\CartService;
use Modules\Product\Contracts\ProductRepositoryInterface;

class CheckoutController extends Controller
{
    public function showPage()
    {
        if ($this->cartIsEmpty()) {
            alert()->error('ناموفق', 'سبد خرید شما خالی است.');
            return back();
        }

        if ($this->checkUserInfo()){
            return redirect()->route('front.checkout.profile.complete.page');
        }

        return view('Front::checkout.checkout');
    }

    public function checkout(Request $request)
    {
        if (CartService::empty()) {
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

    public function checkUserInfo()
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
