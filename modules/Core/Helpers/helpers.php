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
        $session = session()->has('newFeedBack') ?session()->get('newFeedBack') : [];
        $session[] = [ 'title' => $title  , 'body' =>  $body , 'type' => $type ];
        session()->flash('newFeedback'  , $session ) ;
    }
}
