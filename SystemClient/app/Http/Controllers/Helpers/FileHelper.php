<?php


namespace App\Http\Controllers\Helpers;


use App\Http\Controllers\Controller;

class FileHelper extends Controller
{



    public static function saveFile($file)
    {
        $imageName = time().'.'. $file->extension();
        $file->move(public_path('images'), $imageName);
        return $imageName;
    }



}
