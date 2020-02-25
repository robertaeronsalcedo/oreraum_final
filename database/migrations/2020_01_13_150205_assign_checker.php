<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AssignChecker extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_checker',function(Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('checker_id');
            $table->foreign('checker_id')->references('id')->on('users');
            $table->unsignedInteger('student_id');
            $table->foreign('student_id')->references('id')->on('users');
            $table->unsignedInteger('manuscript_id');
            $table->foreign('manuscript_id')->references('id')->on('manuscripts');
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
        Schema::dropIfExists('assign_checker');
    }
}
