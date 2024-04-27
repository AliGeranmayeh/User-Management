<?php

namespace Database\Seeders;

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
        $data= [
            [
                'id' => 1,
                'name'=> 'admin',
            ],
            [
                'id' => 2,
                'name'=> 'employee',
            ],
        ];

        Role::create($data);
    }
}
