<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Product\Contracts\ProductRepositoryInterface;

class CompareController extends Controller
{
    public string $compare = 'compare-list';

    public function index()
    {
        if (!session()->has($this->compare) || empty(session()->get($this->compare))) {
            session()->forget($this->compare);
            return redirect('/');
        }
        $products = resolve(ProductRepositoryInterface::class)->findProductByIds(session()->get($this->compare));
        return view('Front::compare.index', compact('products'));
    }

    public function add($productId)
    {
        if (!session()->has($this->compare) || !in_array($productId, session()->get($this->compare))) {
            session()->push($this->compare, $productId);
            if (count(session()->get($this->compare)) >= 2) {
                return redirect()->route('front.compare.index');
            }
            return back();
        }
        if (count(session()->get($this->compare)) >= 2) {
            return redirect()->route('front.compare.index');
        }
        return back();
    }

    public function remove($productId)
    {
        $compareItems = session()->get($this->compare);
        foreach ($compareItems as $key => $compareItem) {
            if ($compareItem == $productId) {
                session()->pull($this->compare . $key);
            }
        }
        return back();
    }

}
