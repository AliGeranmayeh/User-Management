<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $isAdminExist = User::where('role_id',1)->exists();
        if (!$isAdminExist) {
            $user = User::create([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password'=> 'password',
                'personal_code' => 1,
                'role_id' => 1,
                'image' => null,
            ]);
        }
    }
}
