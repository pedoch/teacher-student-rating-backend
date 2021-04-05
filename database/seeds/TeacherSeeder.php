<?php

use Illuminate\Database\Seeder;
use App\Teacher;
use App\User;
use App\Department;
class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Teacher::firstOrCreate([
            'first_name'=>'Reni',
            'last_name'=>'Oluwa',
            'email'=>'renioluwa@gmail.com',
            'teacher_id'=>'TEA123',
            'gender'=>1,
            'user_id'=> User::where('email', 'renioluwa@gmail.com')->first()->id,
            'department_id'=>Department::where('name', 'Software engineering')->first()->id,
        ]);
    }
}
