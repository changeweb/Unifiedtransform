<?php

use Illuminate\Database\Seeder;

class SyllabusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Syllabus::class, 50)->create();
    }
}
