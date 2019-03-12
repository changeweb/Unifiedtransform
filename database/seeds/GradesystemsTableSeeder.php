<?php

use Illuminate\Database\Seeder;

class GradesystemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Gradesystem::class, 2)->create();
    }
}
