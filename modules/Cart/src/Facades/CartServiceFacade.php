<?php

namespace Modules\Cart\Facades;

use Illuminate\Support\Facades\Facade;
use Modules\Product\Models\Product;

/**
 * @method static array add(Product $product ,array $inputs )
 * @method static array update(array $quantities)
 * @method static  getItems()
 * @method static  getTotal()
 * @method static  isEmpty()
 * @method static  clearAll()
 * @method static  remove(int $id)
 */
class CartServiceFacade extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'cart_service';
    }


}
