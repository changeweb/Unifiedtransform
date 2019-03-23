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
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->string('role');
            $table->tinyInteger('active');
            $table->integer('school_id');
            $table->integer('code');//given by us
            $table->integer('student_code')->unique();// given by us
            $table->string('gender')->default('');
            $table->string('blood_group')->default('');
            $table->string('nationality')->default('');
            $table->string('phone_number')->unique()->default('');
            $table->string('address')->default('');
            $table->text('about')->default('');
            $table->string('pic_path')->default('');
            $table->tinyInteger('verified');
            $table->integer('section_id')->unsigned();
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
