<?php

use Illuminate\Database\Seeder;

class ClassroomSeader extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Classroom::class,200)->create();
    }
}
