<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Services\UserService;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usersData = [
            [
                'name' => 'Jayliste',
                'email' => 'jayliste@gmail.com',
                'password' => Hash::make('password'),
            ],

            [
                'name' => 'Anaa User',
                'email' => 'anaa@gmail.com',
                'password' => Hash::make('password'),
            ],
        ];
        
        $users = UserService::all();
        
        if($users->count() < 1)
        {
            foreach($usersData as $validated)
            {
                UserService::store($validated);
            }
        }
    }
}
