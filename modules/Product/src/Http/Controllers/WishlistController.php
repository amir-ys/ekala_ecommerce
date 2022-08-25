<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Product\Contracts\ProductRepositoryInterface;

class WishlistController extends Controller
{
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepo = $productRepository;
    }

    public function add($productId)
    {
        $wishlist = $this->productRepo->findProductInWishlist($productId, auth()->id());
        if ($wishlist) {
            alert()->warning('متاسفم', 'این محصول از قبل در لیست علاقه مندی ها شما وجود دارد');
            return back();
        }
        $this->productRepo->addToWishlist($productId, auth()->id());
        alert()->success('موفقیت آمیز', 'محصول با موفقیت به لیست علاقه مندی ها اضافه شد.');
        return back();
    }

    public function remove($productId)
    {
        $this->productRepo->removeFromWishlist($productId, auth()->id());
        alert()->success('موفقیت آمیز', 'محصول با موفقیت از لیست علاقه مندی ها حذف شد.');
        return back();
    }
}
