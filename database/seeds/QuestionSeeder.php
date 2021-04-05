<?php

use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
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
            'title' => "Clarity of teacher's presentations",
            'section_id' => 1,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ));
        array_push($data, array(
            'title' => "Teacher's skill in relating course material to real life situations",
            'section_id' => 1,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ));
        array_push($data, array(
            'title' => "Clarity of the syllabus in stating course objectives, course outline, and criteria for grades",
            'section_id' => 1,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ));
        array_push($data, array(
            'title' => "Extent to which interest in subject matter was generated in this course",
            'section_id' => 1,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ));
        array_push($data, array(
            'title' => "Clarity of teacher's explanation",
            'section_id' => 1,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ));
        array_push($data, array(
            'title' => "Mastery and understanding of topics and problems discussed by teacher",
            'section_id' => 1,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ));
        array_push($data, array(
            'title' => "Adequacy of tutorial hours and method",
            'section_id' => 1,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ));
        array_push($data, array(
            'title' => "Clarity of assessment criteria",
            'section_id' => 2,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ));
        array_push($data, array(
            'title' => "Fairness of question and scoring procedure",
            'section_id' => 2,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ));
        array_push($data, array(
            'title' => "Teacher's respect for students as individuals",
            'section_id' => 3,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ));
        array_push($data, array(
            'title' => "Teacher's management and control of class",
            'section_id' => 3,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ));
        array_push($data, array(
            'title' => "Teacher's prayers with students in class",
            'section_id' => 4,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ));
        array_push($data, array(
            'title' => "Teacher's concepts biblical values into course content and assignments",
            'section_id' => 4,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ));
        array_push($data, array(
            'title' => "What is the percentage of teacher's attendance to class?",
            'section_id' => 5,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ));
        array_push($data, array(
            'title' => "What is the percentage of teacher's punctuality to class",
            'section_id' => 5,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ));
        DB::table('questions') ->truncate();
        DB::table('questions')->insert($data);
    }
}
