<?php

namespace Modules\Front\Services;

class CartService
{
    /**
     * @throws \Darryldecode\Cart\Exceptions\InvalidConditionException
     */
    public static function add($product, $attributes)
    {
        $rowId = $product->id . $attributes['color_id'] . $attributes['warranty_id'];
        $originalPrice =$product->calcProductPrice($attributes['color_id'] , $attributes['warranty_id'] , true);
        $productPriceWithAttributes =$product->calcProductPrice($attributes['color_id'] , $attributes['warranty_id']);
        $colorName = $product->colorName($attributes['color_id']);
        $warrantyName = $product->warrantyName($attributes['warranty_id']);

        $currentItem = \Cart::get($product->id);


        if (!$currentItem) {
            \Cart::add(array(
                'id' => $rowId ,
                'name' => $product->name,
                'price' => $originalPrice,
                'attributes' => [
                    'color' =>  [
                        'id' =>  $attributes['color_id'] ?? null ,
                        'name' =>  $colorName
                    ],
                    'warranty' => [
                        'id' => $attributes['warranty_id'] ?? null ,
                        'name' => $warrantyName
                    ],
                    'price_with_discount' => $productPriceWithAttributes
                ],
                'quantity' => $attributes['quantity'],
                'associatedModel' => $product,
            ));
            return ['status' => 'add' ];
        }


        $colorNameStatus = $attributes['color_id'] != $currentItem['attributes']['color'];
        $warrantyNameStatus = $attributes['warranty_id'] == $currentItem['attributes']['warranty'];
        if ($colorNameStatus || $warrantyNameStatus) {
            \Cart::add(array(
                'id' => $rowId,
                'name' => $product->name,
                'price' => $originalPrice,
                'attributes' => [
                    'color' => $colorName ,
                    'warranty' => $warrantyName ,
                    'price_with_discount' => $productPriceWithAttributes
                ],
                'quantity' => $attributes['quantity'],
                'associatedModel' => $product,
            ));
            return ['status' => 'add' ];
        }

        if (($currentItem->quantity + $attributes['quantity']) > $product->quantity) {
            return ['status' => 'invalid-quantity'];
        }

        \Cart::update($rowId, array(
            'name' => $product->name,
            'price' => $originalPrice,
            'attributes' => [
                'color' => $colorName ,
                'warranty' => $warrantyName ,
                'price_with_discount' => $productPriceWithAttributes
            ],
            'quantity' => $attributes['quantity'],
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

    public static function getFinalAmount(): float|int
    {
       return self::getTotal() - getDiscountAmount();
    }
}
