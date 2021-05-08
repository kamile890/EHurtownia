<?php


namespace App\Http\Controllers\Clients;


use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;

class ClientsList extends Controller
{

    public function index()
    {
        $clients = User::where('role_id', Role::where('id', 3)->first()->id)->get();
        return view('Clients.clients', compact('clients'));
    }

}
