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
            $table->enum('day',['Понедельние','Вторник','Среда','Четверг','Пятница','Суббота']);
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('teach_id');
            $table->unsignedBigInteger('classroom_id');
            $table->enum('semester',['1','2']);
            $table->timestamps();
        });
        Schema::table('timetables',function (Blueprint $table){
            $table->foreign('class_id')
                ->references('id')->on('classes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('teach_id')
                ->references('id')->on('teach')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('classroom_id')
                ->references('id')->on('classrooms')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
