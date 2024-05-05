<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $userData = [
            [
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => bcrypt('admin9393')
            ],
            [
                'name' => 'Kasir',
                'email' => 'kasir@gmail.com',
                'role' => 'kasir',
                'password' => bcrypt('kasir1993')
            ],
            [
                'name' => 'Owner',
                'email' => 'owner@gmail.com',
                'role' => 'owner',
                'password' => bcrypt('owner9393')
            ]
        ];

        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
