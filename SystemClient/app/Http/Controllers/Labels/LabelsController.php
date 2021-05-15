<?php


namespace App\Http\Controllers\Labels;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\HttpResponse;
use App\Models\Label;
use App\Models\Setting;
use Illuminate\Http\Request;

class LabelsController extends Controller
{

    public function index()
    {

        $labels = Label::all();

        return view('Labels/labels', compact('labels'));
    }

    public function addLabel(Request $request)
    {

        if(!$request->get('name'))
        {
            $message = 'Name cannot be empty';
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

        $label = Label::where('name', $request->get('name'))->first();

        if($label)
        {
            $message = 'Etykieta z taką nazwą już istnieje.';
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

        try {
            Label::create([
                'name' => $request->get('name'),
                'color' => $request->get('color'),
            ]);
            $message = 'Etykieta została utworzona!';
            $response = HttpResponse::success($message);
            return back()->with(['message' => $response]);
        }
        catch (\Exception $ex)
        {
            $message = 'Something went wrong! Try again!';
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }
    }

    public function editLabel(Request $request)
    {

        if(!$request->get('name'))
        {
            $message = 'Name cannot be empty';
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

        $label = Label::where('name', $request->get('name'))->first();

        if($label && $label->name != $request->get('name'))
        {
            $message = 'Etykieta z taką nazwą już istnieje.';
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

        try
        {
            Label::where('name', $request->get('name'))->update(
                [
                    'name' => $request->get('name'),
                    'color' => $request->get('color')
                ]);
            $message = 'Successfully updated!';
            $response = HttpResponse::success($message);
            return back()->with(['message' => $response]);
        }
        catch(\Exception $ex)
        {
            $message = 'Something went wrong, try again!';
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }


    }

    public function deleteLabel(Request $request)
    {

        if(!$request->get('name'))
        {
            $message = 'Something went wrong, try again!!!!';
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

        try
        {
            Label::where('name', $request->get('name'))->delete();

            $setting = Setting::where('name', 'selectedLabel')->first();

            if($setting->value == $request->get('name'))
            {
                Setting::where('name', 'selectedLabel')->update([
                    'value' => '0'
                ]);
            }

            $message = 'Successfully deleted!';
            $response = HttpResponse::success($message);
            return back()->with(['message' => $response]);
        }
        catch(\Exception $ex)
        {
            $message = 'Something went wrong, try again!';
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

    }

}
