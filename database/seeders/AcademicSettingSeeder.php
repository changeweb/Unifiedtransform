<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AcademicSetting;

class AcademicSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AcademicSetting::factory()->count(1)->create();
    }
}
