<?php

namespace Modules\Cart\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Modules\Cart\Facades\CartServiceFacade;
use Modules\Product\Contracts\ProductRepositoryInterface;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = CartServiceFacade::getItems();
        //todo $suggestionProduct
        $suggestionProducts = resolve(ProductRepositoryInterface::class)->getLatest();
        return view('Front::cart.index', compact('cartItems', 'suggestionProducts'));
    }

    public function add(Request $request)
    {
        $this->validateInputs();

        $product = $this->findActiveAndMarketableProduct($request->product_id);
        if (!$product) {
            alert()->error('ناموفق', 'اطلاعات محصول تعییر پیدا کرده است.');
            return back();
        }

        $this->checkRequestQuantity($product, $request->quantity, $request->color_id);

        $inputs = ['quantity' => $request->quantity, 'color_id' => $request->color_id, 'warranty_id' => $request->warranty_id,];
        $result = CartServiceFacade::add($product, $inputs);

        if ($result['status'] == 'invalid-quantity') {
            alert()->error('دقت کنید', 'تعداد انتخابی محصول بیش از موجودی فروشگاه است.');
            return back();
        }

        alert()->success('موفق آمیز', 'محصول با موفقیت به سبد خرید شما اضافه شد.');
        return back();
    }

    public function clear()
    {
        CartServiceFacade::clearAll();
        alert()->success('موفقیت آمیز', 'سبد خرید شما با موفقیت خالی شد.');
        return back();
    }

    public function remove($id)
    {
        CartServiceFacade::remove($id);
        alert()->success('موفقیت آمیز', 'محصول با موفقیت از سبد خرید حذف شد.');
        return back();
    }

    public function update(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'quantity' => ['required']
        ]);

        if ($validateData->fails()) {
            alert()->warning('عملیات ناموفق', 'تعداد وارد شده صحیح نیست');
            return back();
        }

        CartServiceFacade::update($request->quantity);
        alert()->success('عملیات موفق', 'سبد با موفقیت بروزرسانی شد');
        return back();

    }

    private function validateInputs()
    {
        $data = Validator::make(\request()->all(), [
            'color_id' => ['required', 'numeric', Rule::exists('product_colors', 'id')],
            'warranty_id' => ['nullable', 'numeric', Rule::exists('product_warranties', 'id')],
            'quantity' => ['required', 'numeric', 'min:1'],
        ], [], ['color_id' => 'رنگ', 'warranty_id' => 'گارانتی']);

        if ($data->fails()) {
            if ($data->errors()->has('quantity')) {
                alert()->warning('ناموفق', 'تعداد محصول انتخاب شده صحیح نیست.');
                back()->throwResponse();
            }
            alert()->warning('ناموفق', $data->errors()->first());
            back()->throwResponse();
        }
    }

    private function findActiveAndMarketableProduct($productId)
    {
        return resolve(ProductRepositoryInterface::class)->findActiveById($productId);
    }

    private function checkRequestQuantity($product, $quantity, $colorId): void
    {
        if (!empty($quantity) && $quantity > $product->findColorById($colorId)->quantity) {
            alert()->error('ناموفق', 'تعداد انتخابی محصول بیش از موجودی فروشگاه است.');
            back()->throwResponse();
        }
    }
}
