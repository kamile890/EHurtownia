<?php

namespace Database\Seeders;

use App\Http\Controllers\Helpers\AvailableSystemRoles;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (AvailableSystemRoles::getRoles() as $role)
        {
            Role::create([
                'name' => $role
            ]);
        }

    }
}
