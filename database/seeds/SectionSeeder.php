<?php

use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
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
            'title' => 'Teaching methodology',
            'rate_min' => 1,
            'rate_max' => 5,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ));
        array_push($data, array(
            'title' => 'Assessment procedures',
            'rate_min' => 1,
            'rate_max' => 5,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ));
        array_push($data, array(
            'title' => 'Integration of faith/christian concepts/values in teaching',
            'rate_min' => 1,
            'rate_max' => 5,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ));
        array_push($data, array(
            'title' => 'Classroom management',
            'rate_min' => 1,
            'rate_max' => 5,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ));
        array_push($data, array(
            'title' => 'Teachers attendance and punctuality',
            'rate_min' => 1,
            'rate_max' => 100,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ));
        DB::table('sections') ->truncate();
        DB::table('sections')->insert($data);
    }
}
