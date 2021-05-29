<?php

namespace Database\Seeders;

use App\Models\DeliveryType;
use Illuminate\Database\Seeder;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $params = [];

        $params[] = [
            'name' => 'Kurier DHL',
            'price' => 12.99
        ];

        $params[] = [
            'name' => 'Kurier InPost',
            'price' => 8.99
        ];

        $params[] = [
            'name' => 'Kurier DPD',
            'price' => 10.99
        ];

        foreach ($params as $param)
        {
            DeliveryType::create($param);
        }

    }
}
