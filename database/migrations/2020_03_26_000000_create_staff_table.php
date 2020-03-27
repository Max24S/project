<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('name','50');
            $table->string('surname','50');
            $table->string('patronymic','50');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('number',20)->nullable();
            $table->string('address');
            $table->string('birthday');
            $table->enum('sex',['Мужчина','Женщина']);
            $table->enum('role',['Директор','Админ','Завуч','Учитель']);
            $table->string('description');
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
        Schema::dropIfExists('staff');
    }
}
