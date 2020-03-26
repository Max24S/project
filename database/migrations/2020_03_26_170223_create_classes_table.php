<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *gg
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('name',4);
            $table->unsignedBigInteger('staff_id');
            $table->unsignedBigInteger('classroom_id');
            $table->timestamps();
        });

        Schema::create('classes', function (Blueprint $table) {
            $table->foreign('staff_id')
                ->references('id')
                ->on('classes')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('classroom_id')
                ->references('id')
                ->on('classes')
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
        Schema::dropIfExists('classes');
    }
}
