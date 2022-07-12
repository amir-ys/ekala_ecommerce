<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
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
        return view('Front::checkout.checkout');
    }

    public function checkout()
    {
        if (CartService::empty()) {
            alert()->error('ناموفق' , 'سبد خرید شما خالی است.');
            return back();
        }
        $this->checkForCorrectValues();
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
            if ($product && ($cartItem->price != $product->price )){
                CartService::clearAll();
                alert()->error( 'ناموفق' , 'قیمت محصولات تغییر پیدا کرده است.');
                return back();
            }

            if ($product && ($cartItem->quantity > $product->quantity )){
                CartService::clearAll();
                alert()->error( 'ناموفق' , 'موجودی محصولات تغییر پیدا کرده است.');
                return back();
            }
        }
    }

}
