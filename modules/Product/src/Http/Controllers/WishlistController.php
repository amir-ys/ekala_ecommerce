<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Core\Responses\AjaxResponse;
use Modules\Product\Contracts\ProductRepositoryInterface;

class WishlistController extends Controller
{
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepo = $productRepository;
    }

    public function addOrRemove($productId)
    {
        $wishlistStatus = $this->productRepo->addOrRemoveProductFromWishlist($productId, auth()->id());
        return AjaxResponse::sendData($wishlistStatus);
    }

    public function checkUserIsLogin()
    {
        alert()->warning('ناموفق', 'برای اضافه کردن محصول به لیست علاقه مندی ابتدا باید وارد حساب کاربری خود شوید');
        return back();
    }

}
