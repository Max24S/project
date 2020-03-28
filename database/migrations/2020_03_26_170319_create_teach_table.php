<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teach', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('staff_id');
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
     *f
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teach');
    }
}
