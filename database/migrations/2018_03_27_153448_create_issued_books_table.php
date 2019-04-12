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
          $table->integer('student_code');
          $table->integer('book_id')->unsigned();
          $table->integer('quantity');
          $table->integer('school_id')->unsigned();
          $table->date('issue_date');
          $table->date('return_date');
          $table->decimal('fine');
          $table->tinyInteger('borrowed');
          $table->integer('user_id')->unsigned();
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
