<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('file_path');
            $table->string('title');
            $table->integer('given_to');
            $table->tinyInteger('active');
            $table->bigInteger('school_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('school_id')->references('id')->on('schools');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificates');
    }
}
