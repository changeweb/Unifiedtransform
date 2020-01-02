<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReinstatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reinstates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('session');
            $table->integer('user_id')->unsigned();
            $table->integer('inactive_id')->unsigned();
            $table->text('notes')->nullable();
            $table->boolean('approved');
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
        Schema::dropIfExists('reinstates');
    }
}
