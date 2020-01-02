<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterStudentInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_infos', function (Blueprint $table) {
            $table->integer('category_id')->default(1);
            $table->integer('tct_id')->nullable();
            $table->integer('form_id')->nullable();
            $table->integer('form_num')->nullable();
            $table->integer('house_id')->nullable();
            $table->string('church')->default('');
            $table->string('previous_form')->default('');
            $table->string('previous_school')->default('');
            $table->text('reg_notes')->default('');
            $table->string('version')->nullable()->change();
            $table->string('group')->nullable()->change();
            $table->string('father_name')->nullable()->change();
            $table->string('father_phone_number')->nullable()->change();
            $table->string('father_national_id')->nullable()->change();
            $table->string('father_occupation')->nullable()->change();
            $table->string('father_designation')->nullable()->change();
            $table->integer('father_annual_income')->nullable()->change();
            $table->string('mother_name')->nullable()->change();
            $table->string('mother_phone_number')->nullable()->change();
            $table->string('mother_national_id')->nullable()->change();
            $table->string('mother_occupation')->nullable()->change();
            $table->string('mother_designation')->nullable()->change();
            $table->integer('mother_annual_income')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_infos', function (Blueprint $table) {
            $table->dropColumn('category_id');
            $table->dropColumn('tct_id');
            $table->dropColumn('church');
            $table->dropColumn('form_id');
            $table->dropColumn('form_num');
            $table->dropColumn('house_id');
            $table->string('version')->nullable(false)->change();
            $table->string('group')->nullable(false)->change();
            $table->string('father_name')->nullable(false)->change();
            $table->string('father_phone_number')->nullable(false)->change();
            $table->string('father_national_id')->nullable(false)->change();
            $table->string('father_occupation')->nullable(false)->change();
            $table->string('father_designation')->nullable(false)->change();
            $table->integer('father_annual_income')->nullable(false)->change();
            $table->string('mother_name')->nullable(false)->change();
            $table->string('mother_phone_number')->nullable(false)->change();
            $table->string('mother_national_id')->nullable(false)->change();
            $table->string('mother_occupation')->nullable(false)->change();
            $table->string('mother_designation')->nullable(false)->change();
            $table->integer('mother_annual_income')->nullable(false)->change();
        });
    }
}
