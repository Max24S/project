<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name','50');
            $table->string('surname','50');
            $table->string('patronymic','50');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp('birthday');
            $table->unsignedBigInteger('grade_id');
            $table->enum('sex',['Мужчина','Женщина']);
            $table->timestamps();
        });

        Schema::table('students', function (Blueprint $table) {
            $table->foreign('grade_id')
                ->references('id')
                ->on('grades')
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
        Schema::dropIfExists('students');
    }
}
