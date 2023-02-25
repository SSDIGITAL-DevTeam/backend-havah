<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
            
        User::create([
            'name' => 'Muhammad Riansyah',
            'birth' => '2000-10-03',
            'phone_number' => '085261402481',
            'email' => 'mriansyah38@gmail.com',
            'password' => Hash::make('123456')
        ]);
        User::create([
            'name' => 'Bella',
            'birth' => '2000-10-03',
            'phone_number' => '085261402482',
            'email' => 'bella@gmail.com',
            'password' => Hash::make('123456')
        ]);
        User::create([
            'name' => 'Ardi',
            'birth' => '2000-10-03',
            'phone_number' => '085261402483',
            'email' => 'ardi@gmail.com',
            'password' => Hash::make('123456')
        ]);
        User::create([
            'name' => 'Mahendra F',
            'birth' => '2000-10-03',
            'phone_number' => '085261402484',
            'email' => 'mahen@gmail.com',
            'password' => Hash::make('123456')
        ]);
        User::create([
            'name' => 'Della',
            'birth' => '2000-10-03',
            'phone_number' => '085261402485',
            'email' => 'della@gmail.com',
            'password' => Hash::make('123456')
        ]);
    
    }
}
