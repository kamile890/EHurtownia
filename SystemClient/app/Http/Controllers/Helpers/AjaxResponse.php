<?php

namespace App\Http\Controllers\Helpers;

class AjaxResponse
{

    public static function success($message)
    {
        return [
            'type' => 'success',
            'message' => $message
        ];
    }

    public static function error($message)
    {
        return [
            'type' => 'error',
            'message' => $message
        ];
    }

    public static function custom($message, $type)
    {
        return [
            'type' => $type,
            'message' => $message
        ];
    }
}
