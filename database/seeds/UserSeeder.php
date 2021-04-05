<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate([
            'first_name'=>'',
            'last_name'=>'',
            'role'=>Role::where('name', ),
            'image_path'=>'teacher/me_1601647762.jpeg',
            'email'=>'tireni@gmail.com',
            'password'=>'password',
        ])
    }
}
