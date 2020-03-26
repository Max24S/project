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
        Schema::table('teach',function (Blueprint $table){
            $table->foreign('subject_id')
                ->references('id')->on('subjects')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('staff_id')
                ->references('id')->on('staff')
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
