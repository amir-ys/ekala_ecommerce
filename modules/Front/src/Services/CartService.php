<?php

namespace Modules\Front\Services;

class CartService
{
    public static function add($product, $inputs)
    {
        $rowId = $product->id . $inputs['color_id'] . $inputs['warranty_id'];
        $productPriceWithAttributes =$product->priceWithAttributes($inputs['color_id'] , $inputs['warranty_id']);
        $productPriceWithAttributesAndDiscount =$product->priceWithAttributes($inputs['color_id'] , $inputs['warranty_id'] , true);
        $colorName = $product->colorName($inputs['color_id']);
        $warrantyName = $product->warrantyName($inputs['warranty_id']);

        $currentItem = \Cart::get($product->id);

        if (!$currentItem) {
            \Cart::add(array(
                'id' => $rowId ,
                'name' => $product->name,
                'price' => $productPriceWithAttributes,
                'attributes' => [
                    'color' =>  [
                        'id' =>  $inputs['color_id'] ?? null ,
                        'name' =>  $colorName
                    ],
                    'warranty' => [
                        'id' => $inputs['warranty_id'] ?? null ,
                        'name' => $warrantyName
                    ],
                    'price_with_discount' => $productPriceWithAttributesAndDiscount
                ],
                'quantity' => $inputs['quantity'],
                'associatedModel' => $product,
            ));
        return ['status' => 'add' ];
        }



        $colorNameStatus = $inputs['color_id'] != $currentItem['attributes']['color']['id'];
        $warrantyNameStatus = $inputs['warranty_id'] == $currentItem['attributes']['warranty']['id'];
        if ($colorNameStatus || $warrantyNameStatus) {
            \Cart::add(array(
                'id' => $rowId,
                'name' => $product->name,
                'price' => $productPriceWithAttributes,
                'attributes' => [
                    'color' =>  [
                        'id' =>  $inputs['color_id'] ?? null ,
                        'name' =>  $colorName
                    ],
                    'warranty' => [
                        'id' => $inputs['warranty_id'] ?? null ,
                        'name' => $warrantyName
                    ],
                    'price_with_discount' => $productPriceWithAttributesAndDiscount
                ],
                'quantity' => $inputs['quantity'],
                'associatedModel' => $product,
            ));
            return ['status' => 'add' ];
        }

        if (($currentItem->quantity + $inputs['quantity']) > $product->quantity) {
            return ['status' => 'invalid-quantity'];
        }

        \Cart::update($rowId, array(
            'name' => $product->name,
            'price' => $productPriceWithAttributes,
            'attributes' => [
                'color' =>  [
                    'id' =>  $inputs['color_id'] ?? null ,
                    'name' =>  $colorName
                ],
                'warranty' => [
                    'id' => $inputs['warranty_id'] ?? null ,
                    'name' => $warrantyName
                ],
                'price_with_discount' => $productPriceWithAttributesAndDiscount
            ],
            'quantity' => $inputs['quantity'],
            'associatedModel' => $product,
        ));
        return ['status' => 'add' ];

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
