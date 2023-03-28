<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name'      =>'User',
                'email'     =>'user@gmail.com',
                'password'  =>bcrypt('123456'),
                'role'      =>0
            ],

            [
                'name'      =>'Editor',
                'email'     =>'editor@gmail.com',
                'password'  =>bcrypt('123456'),
                'role'      =>1
            ],

            [
                'name'      =>'Admin',
                'email'     =>'admin@gmail.com',
                'password'  =>bcrypt('123456'),
                'role'      =>2
            ],
        ];
        foreach($user as $users){
            User::create($users);
        }
    }
}
