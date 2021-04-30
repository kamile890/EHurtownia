<?php


namespace App\Http\Controllers\Helpers;


class HttpRequestHelper
{

    public static function getArray($request)
    {
        $return = [];
        foreach($request as $key=>$param)
        {
            $return[$key] = $param;
        }
        return $return;
    }

}
