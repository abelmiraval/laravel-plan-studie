<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('course_id')->unsigned();
            $table->integer('number_times')->unsigned();
            $table->string('curriculum');
            $table->timestamps();

            // $table->string('course_code');
            // $table->string('course_name');
            // $table->integer('course_theoretical_hours');
            // $table->integer('course_practical_hours');
            // $table->integer('course_credits');
            // $table->string('course_requeriments');
            // $table->string('course_level');
            // $table->string('veces en curriculo');
            // $table->string('course_term_name');
            // $table->string('curriculo al que pertenece');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
