<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('student_id')->unsigned();
            $table->bigInteger('section_id')->unsigned();
            $table->bigInteger('exam_id')->unsigned();
            $table->tinyInteger('present')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            // $table->foreign('student_id')->references('student_code')->on('users');
            $table->foreign('section_id')->references('id')->on('sections');
            $table->foreign('exam_id')->references('id')->on('exams');
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
        Schema::dropIfExists('attendances');
    }
}
