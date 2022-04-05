<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name'=>'MUHAMMAD RIZKI',
            'username'=>'humanrizki',
            'email'=>'humanrizki123@gmail.com',
            'password'=>Hash::make('password')
        ]);
        User::create([
            'name'=>'DIMAS PRASETYO',
            'username'=>'dp',
            'email'=>'dp@gmail.com',
            'password'=>Hash::make('password')
        ]);
        User::create([
            'name'=>'DECKY',
            'username'=>'deku',
            'email'=>'deku@gmail.com',
            'password'=>Hash::make('password')
        ]);
        User::create([
            'name'=>'OTONG',
            'username'=>'otong',
            'email'=>'otong@gmail.com',
            'password'=>Hash::make('password')
        ]);
    }
}
