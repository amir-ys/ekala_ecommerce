<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Modules\Front\Services\CartService;
use Modules\Payment\Facades\PaymentServiceFacade;
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
        return view('Front::checkout.save-address-and-delivery' , compact('userAddresses' , 'deliveryMethods'));
    }

    public function addressAndDeliverySave(): RedirectResponse
    {
        $this->validateInputs();

        $paymentService = resolve( PaymentServiceFacade::class);
        $paymentService->saveAddressAndDelivery(auth()->id());
        $paymentService->saveOrderAmounts(auth()->id());

        return redirect()->route('front.checkout.page');
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

    private function validateInputs(){
        $validated = Validator::make(\request()->all(),
            [
                'address_id' => ['required', 'exists:user_addresses,id'],
                'delivery_id' => ['required', 'exists:delivery,id']
            ],
            [],
            [
                'delivery_id' => 'روش ارسال',
                'address_id' => 'آدرس '
            ]);

        if ($validated->fails()) {
            if ($validated->errors()->has('delivery_id')) {
                alert()->warning('خطا', $validated->errors()->get('delivery_id'));
                back()->throwResponse();
            } elseif ($validated->errors()->has('address_id')) {
                alert()->warning('خطا', $validated->errors()->get('address_id'));
                back()->throwResponse();
            }
        }
    }

}
