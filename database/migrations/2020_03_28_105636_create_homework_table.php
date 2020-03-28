<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeworkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homework', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teach_id');
            $table->string('name');
            $table->string(' description');
            $table->enum('status',['Выдано','Проверено']);
            $table->timestamps();
        });
        Schema::table('homework', function (Blueprint $table) {
            $table->foreign('teach_id')
                ->references('id')
                ->on('teach')
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
        Schema::dropIfExists('homework');
    }
}
