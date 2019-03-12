<?php

use Illuminate\Database\Seeder;

class HomeworksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Homework::class, 50)->create();
    }
}
