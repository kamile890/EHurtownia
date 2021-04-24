<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'value',
    ];

    public $timestamps = false;

    public function createOrUpdate(){
        $exist = Setting::where('name', $this->name)->first();

        if($exist)
        {
            return  Setting::where('name', $this->name)->update(['value' => $this->value]);
        }
        else
        {
            return Setting::create([
                'name' => $this->name,
                'value' => $this->value
            ]);
        }
    }

}
