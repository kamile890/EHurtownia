<?php


namespace App\Http\Controllers\Helpers;


class AvailableSystemRoles
{

    const ROLES = ['Administrator', 'Hurtownik', 'Klient'];


    public static function getRoles()
    {
        return self::ROLES;
    }
}
