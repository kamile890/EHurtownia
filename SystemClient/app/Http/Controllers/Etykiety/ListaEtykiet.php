<?php


namespace App\Http\Controllers\Etykiety;


use App\Http\Controllers\Controller;
use App\Models\Etykieta;

class ListaEtykiet extends Controller
{

    public function index()
    {

        $etykietyList = Etykieta::all();

        return view('Etykiety/etykiety', compact('etykietyList'));
    }

}
