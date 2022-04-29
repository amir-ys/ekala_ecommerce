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
