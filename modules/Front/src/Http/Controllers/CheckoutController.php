<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Front\Services\CartService;
use Modules\Payment\Contracts\OrderRepositoryInterface;
use Modules\Payment\Facades\OrderServiceFacade;
use Modules\User\Contracts\UserRepositoryInterface;

class CheckoutController extends Controller
{
    public function addressPage()
    {
        if ($this->cartIsEmpty()) {
            alert()->error('ناموفق', 'سبد خرید شما خالی است.');
            return back();
        }

        if (self::checkUserInfo()) {
            return redirect()->route('front.checkout.profile.complete.page');
        }
        $userAddresses = resolve(UserRepositoryInterface::class)->getActiveAddresses(auth()->id());
        return view('Front::checkout.save-address', compact('userAddresses'));
    }

    public function addressSave(): RedirectResponse
    {
        $this->validateInputs();

        OrderServiceFacade::saveAddress(auth()->id());
        OrderServiceFacade::saveOrderAndOrderItems(auth()->id());

        return redirect()->route('front.checkout.page');
    }

    public function checkoutPage()
    {
        if ($this->cartIsEmpty()) {
            alert()->error('ناموفق', 'سبد خرید شما خالی است.');
            return back();
        }

        if (self::checkUserInfo()) {
            return redirect()->route('front.checkout.profile.complete.page');
        }
        $orderRepo = resolve(OrderRepositoryInterface::class);
        $orderRepo->removeAllBeforeCouponAmountInCurrentOrder(auth()->id());
        $order = $orderRepo->getCurrentOrder(auth()->id());
        return view('Front::checkout.checkout', compact('order'));
    }

    public function checkout(Request $request)
    {
        if ($this->cartIsEmpty()) {
            alert()->error('ناموفق', 'سبد خرید شما خالی است.');
            return back();
        }


        if (self::checkUserInfo()) {
            return redirect()->route('front.checkout.profile.complete.page');
        }

        //todo check quantity of product and price of product after add marketable number

//        $valuesStatus = $this->checkForCorrectValues();
//        if ($valuesStatus && $valuesStatus['status'] == -1){
//            alert()->error('ناموفق' , $valuesStatus['message']);
//            return  redirect()->route('front.cart.index');
//        }
        $this->savePaymentTypeInSession($request->payment_type);
        return redirect()->route('front.payment.pay');
    }

    public function savePaymentTypeInSession($paymentType)
    {
        session()->put(['payment_type' => $paymentType]);
    }

    private function cartIsEmpty()
    {
        return CartService::empty();
    }

    public function checkForCorrectValues()
    {
        //todo check quantity of product and price of product after add marketable number
//        $productRepository = resolve(ProductRepositoryInterface::class);
//        foreach (CartService::getItems() as $cartItem) {
//            $product = $productRepository->findById($cartItem->id);
//            if ($product && ($cartItem->price != $product->finalPrice() )){
//                CartService::clearAll();
//                return [ 'status' => -1 , 'message' => 'قیمت محصولات تغییر پیدا کرده است.'  ];
//            }
//
//            if ($product && ($cartItem->quantity > $product->quantity )){
//                CartService::clearAll();
//                return [ 'status' => -1 , 'message' => 'موجودی محصولات تغییر پیدا کرده است.'  ];
//            }
//        }
        return false;
    }

    public static function checkUserInfo()
    {
        if (empty(auth()->user()->first_name)
            || empty(auth()->user()->last_name)
            || empty(auth()->user()->mobile)
            || empty(auth()->user()->email)
        ) {
            return true;
        }
    }

    private function validateInputs()
    {
        $validated = Validator::make(\request()->all(),
            [
                'address_id' => ['required', 'exists:user_addresses,id'],
            ],
            [],
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

}
