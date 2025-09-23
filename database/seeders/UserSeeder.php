<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'id' => 1,
            'idcode' => 'U000001',
            'status' => 1, //active
            'name' => 'Adminstrator',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'created_at' => now(),
            'password' => bcrypt('password'),// password
            'remember_token' => Str::random(10)
        ];

        $user = User::create($data);
        $user->assignRole('admin');
    }
}
