<?php


namespace App\Http\Controllers\Helpers;


class AjaxRequestHelper
{

    public static function makeArray($params)
    {
        $array = explode('&', $params);
        $return = [];
        foreach($array as $conf)
        {
            $params = explode('=', $conf);
            if($params[1])
            {
                $return[$params[0]] = $params[1];
            }
        }

        return $return;
    }

}
