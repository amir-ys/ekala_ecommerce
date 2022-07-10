<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Front\Services\CartService;
use Modules\Product\Contracts\ProductRepositoryInterface;

class CheckoutController extends Controller
{

    public function showPage()
    {
        if (CartService::empty()){
            alert('ناموفق'  , ' سبد خرید شما خالی است.');
            return back();
        }
        return view('Front::checkout.checkout');
    }

}
