<?php

namespace Modules\Core\Responses;

class AjaxResponse
{
    public static function success($message =  'عملیات موفق' , $error = '')
    {
        return response()->json([
            'status' => 1 ,
            'message' => $message ,
            'error' => $error
        ]);
    }

    public static function error($message =  'خطا در نتیجه عملیات'  , $error = '')
    {
        return response()->json([
            'status' => -1 ,
            'message' => $message ,
            'error' => $error
        ]);
    }

    public static function sendData($data ,$message =  'عملیات موفق'  , $error = '')
    {
        return response()->json([
            'data' => $data ,
            'status' => -1 ,
            'message' => $message ,
            'error' => $error
        ]);
    }



}
