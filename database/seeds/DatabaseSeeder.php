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
         $this->call(StaffTableSeeder::class);
         $this->call(ClassroomSeader::class);
        $this->call(GradeTableSeader::class);
         $this->call(StudentTableSeeder::class);
    }
}
