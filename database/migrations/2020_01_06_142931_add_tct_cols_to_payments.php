<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTctColsToPayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->string('session');
            $table->text('notes')->nullable();
            $table->renameColumn('payment_id','fee_id');
            $table->integer('payment_status')->nullable()->change();
            $table->renameColumn('charge_for', 'receipt');
            $table->date('pay_date');
            $table->renameColumn('custormer_id', 'user_id');
            $table->decimal('amount' , 8, 2)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropcolumn('session');
            $table->dropcolumn('notes');
            $table->renameColumn('fee_id','payment_id');
            $table->integer('payment_status')->nullable(false)->change();
            $table->renameColumn('receipt','charge_for');
            $table->dropcolumn('pay_date');
            $table->renameColumn('user_id', 'custormer_id');
            $table->float('amount')->change();

        });
    }
}
