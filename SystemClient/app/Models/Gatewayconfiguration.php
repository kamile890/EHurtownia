<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gatewayconfiguration extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'configuration',
    ];

    public $timestamps = false;


    public function createOrUpdate(){
        $exist = Gatewayconfiguration::where('name', $this->name)->first();

        if($exist)
        {
           return  Gatewayconfiguration::where('name', $this->name)->update(['configuration' => $this->configuration]);
        }
        else
        {
           return Gatewayconfiguration::create([
                'name' => $this->name,
                'configuration' => $this->configuration
            ]);
        }
    }

}
