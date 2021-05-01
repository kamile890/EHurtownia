<?php


namespace App\Http\Controllers\Helpers;


use App\Models\Template;
use App\Models\User;

class MessageCreator
{
    //dodać zmienne z zamówień
    public static function getMessage(User $client, Template $template)
    {

        $message = $template->content;
        $variables = [];

        foreach($client->toArray() as $key=>$value)
        {
            $variables[$key] = $value;
        }

        foreach ($variables as $key=>$variable)
        {
            if(str_contains($message, '{' . $key . '}'))
            {
                $message = str_replace('{' . $key .'}', $variable, $message);
            }
        }

        return $message;
    }

}
