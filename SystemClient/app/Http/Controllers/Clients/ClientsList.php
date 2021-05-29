<?php


namespace App\Http\Controllers\Clients;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Helpers\HttpRequestHelper;
use App\Http\Controllers\Helpers\HttpResponse;
use App\Http\Controllers\Helpers\SenderHelper;
use App\Models\Custom;
use App\Models\Label;
use App\Models\Role;
use App\Models\Template;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClientsList extends Controller
{

    public function index()
    {
        $clients = User::where('role_id', Role::where('id', 3)->first()->id)->get();

        foreach ($clients as &$client)
        {
            $allCustoms = Custom::whereNotIn('id', unserialize($client->customs) ? unserialize($client->customs) : [])->get()->toArray();
            $client->allCustoms = $allCustoms;

            $allLabels = Label::whereNotIn('id', unserialize($client->labels) ? unserialize($client->labels) : [])->get()->toArray();
            $client->allLabels = $allLabels;

            $clientLabels = [];
            if(!empty(unserialize($client->labels)))
            {
                foreach (unserialize($client->labels) as $labelId)
                {
                    $label = Label::where('id', $labelId)->first()->toArray();
                    $clientLabels[] = $label;
                }
            }
            $client->clientLabels = $clientLabels;
        }

        $templates = Template::all();


        return view('Clients.clients', compact('clients', 'templates'));
    }


    public function editClient(Request $request)
    {
        try
        {
            $params = HttpRequestHelper::getArray($request->all());
            User::where('id', $request->get('id'))->update($params);
            $message = 'Klient został edytowany!';
            $response = HttpResponse::success($message);
            return back()->with(['message' => $response]);
        }
        catch(\Exception $ex)
        {
            $message = 'Something went wrong! Try again!';
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }
    }

    public function editClientCustom(Request $request)
    {

        if(!$request->get('custom'))
        {
            $message = 'Wybierz Custom Field!';
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

        try
        {

            $klient = User::where('id', $request->get('id'))->first();

            $customs = $klient->customs;

            if($customs)
            {
                $customs = unserialize($customs);
            }
            else
            {
                $customs = [];
            }

            array_push($customs, $request->get('custom'));

            User::where('id', $request->get('id'))->update([
                    'customs' => serialize($customs)
                ]);
            $message = 'Custom field został dodany.';
            $response = HttpResponse::success($message);
            return back()->with(['message' => $response]);
        }
        catch(\Exception $ex)
        {
            $message = 'Something went wrong! Try again!';
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

    }

    public function editClientLabel(Request $request)
    {

        if(!$request->get('label'))
        {
            $message = 'Wybierz etykiete!';
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

        try
        {

            $klient = User::where('id', $request->get('id'))->first();

            $labels = $klient->labels;

            if($labels)
            {
                $labels = unserialize($labels);
            }
            else
            {
                $labels = [];
            }

            array_push($labels, $request->get('label'));

            User::where('id', $request->get('id'))->update([
                'labels' => serialize($labels)
            ]);
            $message = 'Etykieta została dodana.';
            $response = HttpResponse::success($message);
            return back()->with(['message' => $response]);
        }
        catch(\Exception $ex)
        {
            $message = 'Something went wrong! Try again!';
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

    }

    public function deleteLabelClient(Request $request)
    {

        try
        {

            $klient = User::where('id', $request->get('client'))->first();

            $labels = unserialize($klient->labels);
            $newLabels = [];
            foreach($labels as $value)
            {
                if($value != $request->get('label'))
                {
                    $newLabels[] = $value;
                }
            }


            User::where('id', $request->get('client'))->update([
                'labels' => serialize($newLabels)
            ]);
            $message = 'Etykieta została usunięta.';
            $response = HttpResponse::success($message);
            return back()->with(['message' => $response]);
        }
        catch(\Exception $ex)
        {
            $message = 'Something went wrong! Try again!';
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

    }

    public function accountData(Request $request)
    {

        $clientId = unserialize(Session::get('client')[0])['id'];


        $client = User::where('id', $clientId)->first();

        return view('Clients.accountData', compact('client'));

    }


    public function saveClientSelf(Request $request)
    {

        try
        {

            $params = HttpRequestHelper::getArray($request->all());

            User::where('id', $request->get('id'))->update(
                $params
            );
            $message = 'Dane zostały edytowane.';
            $response = HttpResponse::success($message);
            return back()->with(['message' => $response]);
        }
        catch(\Exception $ex)
        {
            $message = 'Something went wrong! Try again!';
            $response = HttpResponse::error($message);
            return back()->with(['message' => $response]);
        }

    }

    public function sendToClient(Request $request)
    {

        SenderHelper::sendSMS($request->get('client'), $request->get('template'));

    }
}
