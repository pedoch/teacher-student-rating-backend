<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(QuestionSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(DepartmentSeeder::class);
    }
}
