<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Fatema',
                'email' => 'fatema8989@gmail.com',
                'password' => Hash::make('fatema8989'),
            ],

            [
                'name' => 'test',
                'email' => 'test8989@gmail.com',
                'password' => Hash::make('fatema8989'),
            ]
            ];

            foreach($users as $user){
             User::create($user
            );
            }
    }
}
