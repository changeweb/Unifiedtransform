<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('exam_name');
          $table->tinyInteger('active');
          $table->tinyInteger('notice_published');
          $table->tinyInteger('result_published');
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
        Schema::dropIfExists('exams');
    }
}
