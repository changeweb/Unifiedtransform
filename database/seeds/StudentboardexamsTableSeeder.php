<?php

use Illuminate\Database\Seeder;

class StudentboardexamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\StudentBoardExam::class, 200)->create();
    }
}
