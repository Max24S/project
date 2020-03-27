<?php

use Illuminate\Database\Seeder;

class GradeClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Classroom::class,200,"r")->create();
    }
}
