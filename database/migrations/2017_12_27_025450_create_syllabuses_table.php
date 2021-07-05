<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSyllabusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('syllabuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file_path');
            $table->string('title');
            $table->text('description');
            $table->tinyInteger('active');
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
        Schema::dropIfExists('syllabuses');
    }
}
