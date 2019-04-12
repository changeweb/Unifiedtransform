<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
      		$table->string('book_code',50)->unique();
      		$table->string('title',250);
      		$table->string('author',100);
      		$table->integer('quantity')->unsigned();
      		$table->string('rackNo',10);
      		$table->string('rowNo',10);
            $table->string('img_path');
            $table->text('about');
			$table->string('type',10);
            $table->integer('price');
            $table->integer('class_id')->unsigned();
            $table->integer('school_id')->unsigned();
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
        Schema::dropIfExists('books');
    }
}
