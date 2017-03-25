<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrepostsolFieldQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions',function($table){
            $table->text('pre_code_c')->nullable();
            $table->text('post_code_c')->nullable();

            $table->text('pre_code_cpp')->nullable();
            $table->text('post_code_cpp')->nullable();

            $table->text('pre_code_java')->nullable();
            $table->text('post_code_java')->nullable();

            $table->text('pre_code_py')->nullable();
            $table->text('post_code_py')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions',function($table){
            $table->dropcolumn('pre_code_c');
            $table->dropcolumn('post_code_c');

            $table->dropcolumn('pre_code_cpp');
            $table->dropcolumn('post_code_cpp');

            $table->dropcolumn('pre_code_java');
            $table->dropcolumn('post_code_java');

            $table->dropcolumn('pre_code_py');
            $table->dropcolumn('post_code_py');
        });
    }
}
