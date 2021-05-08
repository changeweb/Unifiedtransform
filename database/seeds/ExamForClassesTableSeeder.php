<?php

use Illuminate\Database\Seeder;

class ExamForClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ExamForClass::class, 30)->create();
    }
}
