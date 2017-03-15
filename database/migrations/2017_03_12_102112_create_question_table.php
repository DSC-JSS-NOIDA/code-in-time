<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->text('details');
            $table->text('constraint');
            $table->text('sample');
            $table->text('input_tc')->default(null);
            $table->text('output_tc')->default(null);
            $table->integer('max_score')->default(0);
            $table->integer('current_score')->default(0);
            $table->integer('correct_sub')->default(0);
            $table->integer('attempted')->default(0);
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
        Schema::drop('questions');
    }
}
