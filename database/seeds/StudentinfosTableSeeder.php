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
        factory(App\StudentInfo::class, 200)->create();
    }
}
