<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamForClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_for_classes', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('class_id')->unsigned();
            $table->bigInteger('exam_id')->unsigned();
            $table->foreign('class_id')->references('id')->on('classes');
            $table->foreign('exam_id')->references('id')->on('exams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_for_classes');
    }
}
