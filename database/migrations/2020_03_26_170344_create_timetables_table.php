<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimetablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timetables', function (Blueprint $table) {
            $table->id();
            $table->string('day',['Понедельние','Вторник','Среда','Четверг','Пятница','Суббота']);
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('teach_id');
            $table->unsignedBigInteger('classroom');
            $table->enum('semester',['1','2']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timetables');
    }
}
