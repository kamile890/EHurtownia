<?php


namespace App\Http\Controllers\Helpers;


class AvailableSystemRoles
{

    const ROLES = ['Administator', 'Hurtownik', 'Klient'];


    public static function getRoles()
    {
        return self::ROLES;
    }
}
