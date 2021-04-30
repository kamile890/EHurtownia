<?php


namespace App\Http\Controllers\Settings;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\AjaxResponse;
use App\Http\Controllers\Helpers\HttpResponse;
use App\Models\Gatewayconfiguration;
use App\Models\Setting;
use App\Models\Template;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Settings extends Controller
{

    public function index()
    {

        $gateways = Gatewayconfiguration::all();
        $templates = Template::all();


        $usedGateway = Setting::where('name', 'selectedGateway')->first() ? Setting::where('name', 'selectedGateway')->first()->value : null;
        $selectedTemplate = Setting::where('name', 'selectedTemplate')->first() ? Setting::where('name', 'selectedTemplate')->first()->value : '0';


        return view('Settings.settings', compact('gateways', 'usedGateway', 'templates', 'selectedTemplate'));
    }

    public function saveSettings(Request $request)
    {

        try
        {
            foreach($request->all() as $key=>$settings)
            {

                $setting = new Setting();
                $setting->name = $key;
                $setting->value = $settings;
                $setting->createOrUpdate();
            }
        }
        catch(\Exception $ex)
        {
            $message = 'Something went wrong! Try again!';
            $response = HttpResponse::custom($message, 'danger');
            return back()->with(['message' => $response]);
        }
        $message = 'Settings successfully updated.';
        $response = HttpResponse::success($message);
        return back()->with(['message' => $response]);
    }

}
