<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Front\Services\CartService;
use Modules\Product\Contracts\ProductRepositoryInterface;

class CartController extends Controller
{

    public function index()
    {
        $cartItems = CartService::getItems();
        return view('Front::cart.index' , compact('cartItems'));
    }

    public function add(Request $request)
    {
        $product = $this->findActiveProduct($request);
        if (!$product) {
            alert()->error('ناموفق', 'محصولی با این شناسه پیدا نشد.');
            return back();
        }

        $isInvalidQuantity = $this->isInvalidateQuantity($product, $request->quantity);
        if ($isInvalidQuantity) {
            alert()->error('ناموفق', 'تعداد وارد شده از محصول صحیح نمی باشد.');
            return back();
        }


        $result = CartService::add($product, $request->quantity);

        if ($result['status'] == 'invalid-quantity'){
            alert()->error('دقت کنید', 'تعداد انتخابی محصول بیش از موجودی فروشگاه است.');
            return back();
        }
        if ($result['status'] == 'add') {
            alert()->success('موفق آمیز', 'محصول با موفقیت به سبد خرید شما اضافه شد.');
            return back();
        }
    }

    private function findActiveProduct(Request $request)
    {
        return resolve(ProductRepositoryInterface::class)->findActiveById($request->product_id);
    }

    private function isInvalidateQuantity($product, $quantity): bool
    {
        if (!empty($quantity) && $quantity > $product->quantity) {
            return true;
        }
        return false;
    }
}
