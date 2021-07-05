<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradeSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade_systems', function (Blueprint $table) {
          $table->increments('id');
          $table->string('grade_system_name');
          $table->string('grade');
          $table->float('point');
          $table->integer('from_mark');
          $table->integer('to_mark');
          $table->bigInteger('school_id')->unsigned();
          $table->bigInteger('user_id')->unsigned();
          $table->foreign('school_id')->references('id')->on('schools');
          $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('grade_systems');
    }
}
