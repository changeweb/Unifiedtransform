<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('house_name');
            $table->string('house_name_ton')->nullable();
            $table->string('house_abbrv');
            $table->boolean('active')->default(1);
            $table->timestamps();

        });

        // DB::table('houses')->insert(
        //    [
        //         [
        //         'house_name' => 'John Thomas',
        //         'house_name_ton' => 'Sione Tomasi',
        //         'house_abbrv' => 'JT',
        //         'active' => TRUE,
        //         ],
        //         [
        //         'house_name' => 'Harold Wood',
        //         'house_name_ton' => 'Haloti Uti',
        //         'house_abbrv' => 'HW',
        //         'active' => TRUE,
        //         ],
        //         [
        //         'house_name' => 'Tevita Tonga',
        //         'house_name_ton' => 'Tevita Tonga',
        //         'house_abbrv' => 'TT',
        //         'active' => TRUE,
        //         ],
        //         [
        //         'house_name' => 'Aho\'eitu',
        //         'house_name_ton' => 'Aho\'eitu',
        //         'house_abbrv' => 'AH',
        //         'active' => TRUE,
        //         ],
        //         [
        //         'house_name' => 'Siupeli Taliai',
        //         'house_name_ton' => 'Siupeli Taliai',
        //         'house_abbrv' => 'ST',
        //         'active' => TRUE,
        //         ],
        //         [
        //         'house_name' => 'Kau Ta\'eiloa',
        //         'house_name_ton' => 'Kau Ta\'eiloa',
        //         'house_abbrv' => 'KT',
        //         'active' => TRUE,
        //         ],
        //         [
        //         'house_name' => 'Howard Secomb',
        //         'house_name_ton' => 'Hauati Sekomi',
        //         'house_abbrv' => 'HS',
        //         'active' => TRUE,
        //         ],
        //         [
        //         'house_name' => 'Sau Faupula',
        //         'house_name_ton' => 'Sau Faupula',
        //         'house_abbrv' => 'SF',
        //         'active' => TRUE,
        //         ],
        //         [
        //         'house_name' => 'John Wesley',
        //         'house_name_ton' => 'Sione \'Uesile',
        //         'house_abbrv' => 'JW',
        //         'active' => TRUE,
        //         ],
        //         [
        //         'house_name' => 'Ronald Woodgate',
        //         'house_name_ton' => '\'Uitikeiti',
        //         'house_abbrv' => 'RW',
        //         'active' => TRUE,
        //         ],
        //         [
        //         'house_name' => 'Roger Page',
        //         'house_name_ton' => 'Losa Peesi',
        //         'house_abbrv' => 'RP',
        //         'active' => TRUE,
        //         ],
        //         [
        //         'house_name' => 'John Havea',
        //         'house_name_ton' => 'Sione Havea',
        //         'house_abbrv' => 'SH',
        //         'active' => TRUE,
        //         ],
        //     ]
        // );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('houses');
    }
}
