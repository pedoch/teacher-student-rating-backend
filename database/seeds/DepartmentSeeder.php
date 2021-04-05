<?php

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        array_push($data, array(
            'name' => 'Computer science',
            'rating_activation'=> false,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ));
        array_push($data, array(
            'name' => 'Computer Tech',
            'rating_activation'=> false,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ));
        array_push($data, array(
            'name' => 'Computer information system',
            'rating_activation'=> false,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ));
        array_push($data, array(
            'name' => 'Software engineering',
            'rating_activation'=> false,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ));
        array_push($data, array(
            'name' => 'Nursing',
            'rating_activation'=> false,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ));
        DB::table('departments')->insert($data);
    }
}
