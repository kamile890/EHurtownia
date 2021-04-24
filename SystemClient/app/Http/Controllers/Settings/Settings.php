<?php


namespace App\Http\Controllers\Settings;


use App\Http\Controllers\Controller;

class Settings extends Controller
{

    public function index()
    {
        return view('Settings.settings');
    }

}
