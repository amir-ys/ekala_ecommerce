<?php

namespace Modules\Front\Services;

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

    public static function update($quantities)
    {
        foreach ($quantities as $rowId => $quantity) {
            \Cart::update($rowId, [
                    'quantity' => array(
                        'relative' => false,
                        'value' => $quantity
                    ),]
            );
        }
    }

    public static function getItems()
    {
       return \Cart::getContent();
    }

    public static function clearAll(): void
    {
        \Cart::clear();
    }

    public static function remove($id): void
    {
        \Cart::remove($id);
    }

    public static function empty()
    {
        return \Cart::isEmpty();
    }

    public static function getTotal()
    {
        return \Cart::getTotal();
    }
}
