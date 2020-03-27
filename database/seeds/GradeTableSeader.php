<?php

use Illuminate\Database\Seeder;

class GradeTableSeader extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Grade::class,200)->create();
    }
}
