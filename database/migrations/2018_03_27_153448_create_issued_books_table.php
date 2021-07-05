<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIssuedBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issued_books', function (Blueprint $table) {
          $table->increments('id');
          $table->bigInteger('student_code');
          $table->bigInteger('book_id')->unsigned();
          $table->integer('quantity');
          $table->bigInteger('school_id')->unsigned();
          $table->date('issue_date');
          $table->date('return_date');
          $table->decimal('fine');
          $table->tinyInteger('borrowed');
          $table->bigInteger('user_id')->unsigned();
          $table->foreign('student_code')->references('student_code')->on('users');
          $table->foreign('book_id')->references('id')->on('books');
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
        Schema::dropIfExists('issued_books');
    }
}
