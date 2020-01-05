<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTctAdjustmentsToFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fees', function (Blueprint $table) {
            $table->integer('fee_channel_id')->unsigned();
            $table->integer('fee_type_id')->unsigned();
            $table->decimal('amount', 8, 2);
            $table->string('session');
            $table->boolean('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fees', function (Blueprint $table) {
            $table->dropColumn('fee_channel_id');
            $table->dropColumn('fee_type_id');
            $table->dropColumn('amount');
            $table->dropColumn('session');
            $table->dropColumn('active');
        });
    }
}
