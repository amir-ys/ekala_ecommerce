<?php

namespace Modules\Front\Services;
use Darryldecode\Cart\Cart;

class CartService
{
    public static function add($product, $quantity)
    {
        $currentItem = \Cart::get($product->id);
        if (!$currentItem) {
            \Cart::add(array(
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->finalPrice(),
                'quantity' => $quantity,
                'attributes' => array(),
                'associatedModel' => $product,
            ));
            return ['status' => 'add' ];
        }

        if (($currentItem->quantity + $quantity) > $product->quantity) {
            return ['status' => 'invalid-quantity'];
        }

        \Cart::update($product->id, array(
            'name' => $product->name,
            'price' => $product->finalPrice(),
            'quantity' => $quantity,
            'attributes' => array(),
            'associatedModel' => $product,
        ));
        return ['status' => 'add'];

    }

    public static function getItems()
    {
       return \Cart::getContent();
    }

}
