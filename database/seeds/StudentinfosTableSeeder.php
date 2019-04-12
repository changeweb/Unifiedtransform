<?php

use Illuminate\Database\Seeder;

class StudentinfosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\StudentInfo::class, 50)->states('without_group')->create();
        factory(App\StudentInfo::class, 25)->states('science')->create();
        factory(App\StudentInfo::class, 15)->states('commerce')->create();
        factory(App\StudentInfo::class, 10)->states('arts')->create();
    }
}
