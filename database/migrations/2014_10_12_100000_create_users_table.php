<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role');
            $table->tinyInteger('active');
            $table->integer('code')->nullable();//school code Auto generated
            $table->bigInteger('student_code')->unique()->nullable();//Auto generated
            $table->string('gender')->default('');
            $table->string('blood_group')->default('');
            $table->string('nationality')->default('');
            $table->string('phone_number')->unique()->default('');
            $table->string('address')->default('');
            $table->text('about')->default('');
            $table->string('pic_path')->default('');
            $table->tinyInteger('verified');
            $table->integer('section_id')->unsigned()->nullable();
            $table->bigInteger('school_id')->unsigned()->nullable();
            $table->foreign('school_id')->references('id')->on('schools');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
