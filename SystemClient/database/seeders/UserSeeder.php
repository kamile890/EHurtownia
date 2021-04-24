<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_role = Role::where('name', 'Administrator')->first();

        User::create([
           'email' => 'admin@gmail.com',
           'haslo' => 'YWRtaW4=',
           'role_id' => $admin_role->id,
            'imie' => 'Admin',
            'nazwisko' => 'Admin'
        ]);
    }
}
