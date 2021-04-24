<?php


namespace App\Http\Controllers\Settings;


use App\Http\Controllers\Controller;
use App\Models\Gatewayconfiguration;
use App\Models\Setting;
use Illuminate\Http\Request;

class Settings extends Controller
{

    public function index()
    {

        $gateways = Gatewayconfiguration::all();

        $usedGateway = Setting::where('name', 'gateway')->first() ? Setting::where('name', 'gateway')->first() : null;


        return view('Settings.settings', compact('gateways', 'usedGateway'));
    }

    public function saveSettings(Request $request)
    {



    }

}
