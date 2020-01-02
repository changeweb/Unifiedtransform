<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegrecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regrecords', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('session');
            $table->integer('form_id')->unsigned();
            $table->integer('form_num');
            $table->integer('house_id')->unsigned();
            $table->string('status');
            // $table->date('reg_date');
            $table->text('notes')->nullable();
            $table->integer('category_id')->default(1);
            $table->integer('fee_id')->unsigned();
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
        Schema::dropIfExists('regrecords');
    }
}
