<?php


if (!function_exists('getJalaliDate')){
    function getJalaliDate($date , $format = 'Y-m-d H:i' )
    {
        if (config('core.show-date') == 'carbon'){
            return \Morilog\Jalali\Jalalian::fromCarbon($date)->format($format);
        }else{
           return $date->diffForHumans();
        }
    }
}

if (!function_exists('newFeedback')){
    function newFeedback($title =  'موفقیت آمیز' , $body = "عملیات با موفقیت انجام شد." , $type = 'success') {
        $session = session()->has('newFeedback') ?session()->get('newFeedback') : [];
        $session[] = [ 'title' => $title  , 'body' =>  $body , 'type' => $type ];
        session()->flash('newFeedback'  , $session ) ;
    }
}


if (!function_exists('getDiscountAmount')){
    function getDiscountAmount() {
        $discountAmount = 0;
        foreach (\Cart::getContent() as $cartItem){
           $discountAmount += $cartItem->associatedModel->discountAmount() * $cartItem->quantity;
        }
        return $discountAmount;
    }

}

