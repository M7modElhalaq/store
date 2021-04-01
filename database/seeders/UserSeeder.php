<?php

namespace Database\Seeders;

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
        User::create([
            'name' => 'Mhmod Elhalaq',
            'email' => 'mhmodelhalaq@gmail.com',
            'password' => bcrypt('123456789'),
            'country' => 'Palestine',
            'role_id' => 1,
            'profile_image' => 'MhmodElhalaq.jpg',
            'gender' => 'male',
        ]);

        User::create([
            'name' => 'Test',
            'email' => 'test@gmail.com',
            'password' => bcrypt('123456789'),
            'country' => 'Palestine',
            'role_id' => 1,
            'profile_image' => 'user_male.png',
            'gender' => 'male',
        ]);

        User::create([
            'name' => 'Test 2',
            'email' => 'test2@gmail.com',
            'password' => bcrypt('123456789'),
            'country' => 'Palestine',
            'role_id' => 1,
            'profile_image' => 'user_male.png',
            'gender' => 'male',
        ]);
    }
}
