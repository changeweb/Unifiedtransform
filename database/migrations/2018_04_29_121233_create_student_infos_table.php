<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_infos', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('student_id')->unsigned();
          $table->string('session');
          $table->string('version');
          $table->string('group');
          $table->dateTime('birthday');
          $table->string('religion');
          $table->string('father_name');
          $table->string('father_phone_number');
          $table->string('father_national_id');
          $table->string('father_occupation');
          $table->string('father_designation');
          $table->integer('father_annual_income');
          $table->string('mother_name');
          $table->string('mother_phone_number');
          $table->string('mother_national_id');
          $table->string('mother_occupation');
          $table->string('mother_designation');
          $table->integer('mother_annual_income');
          $table->integer('user_id')->unsigned()->nullable();
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
        Schema::dropIfExists('student_infos');
    }
}
