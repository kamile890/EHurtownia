<?php


namespace App\Http\Controllers\Helpers;


class PasswordEncoder
{

    public static function base64_encode($pass)
    {
        return base64_encode($pass);
    }

    public static function base64_decode($pass)
    {
        return base64_decode($pass);
    }

}
