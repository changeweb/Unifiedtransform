<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->increments('id');
            $table->float('marks', 8, 2);//final exam
            $table->float('gpa', 8, 2);//final exam
            $table->float('attendance', 8, 2);
            $table->float('quiz1', 8, 2);
            $table->float('quiz2', 8, 2);
            $table->float('quiz3', 8, 2);
            $table->float('quiz4', 8, 2);
            $table->float('quiz5', 8, 2);
            $table->float('ct1', 8, 2);
            $table->float('ct2', 8, 2);
            $table->float('ct3', 8, 2);
            $table->float('ct4', 8, 2);
            $table->float('ct5', 8, 2);
            $table->float('assignment1', 8, 2);
            $table->float('assignment2', 8, 2);
            $table->float('assignment3', 8, 2);
            $table->float('written', 8, 2);
            $table->float('mcq', 8, 2);
            $table->float('practical', 8, 2);
            $table->bigInteger('exam_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->bigInteger('teacher_id')->unsigned();
            $table->bigInteger('course_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            // $table->foreign('student_id')->references('student_code')->on('users');
            $table->foreign('course_id')->references('id')->on('courses');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('teacher_id')->references('id')->on('users');
            $table->foreign('exam_id')->references('id')->on('exams');
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
        Schema::dropIfExists('grades');
    }
}
