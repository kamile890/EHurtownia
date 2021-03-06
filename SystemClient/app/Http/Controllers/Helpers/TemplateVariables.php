<?php


namespace App\Http\Controllers\Helpers;


class TemplateVariables
{

    const VARIABLES = [
        'Klient' => ['{imie}', '{nazwisko}', '{email}', '{miasto}', '{ulica}', '{numermieszkania}', '{kodpocztowy}'],

        'Zamówienie' => ['{numer_zamowienia}', '{cena}', '{stan_zamowienia}', '{rodzaj_dostawy}', '{data_zlozenia}', '{termin_dostawy}',
            '{wysokosc_znizki}', '{informacje_o_produktach}', '{cena_ubezpieczenia}'],
    ];

}
