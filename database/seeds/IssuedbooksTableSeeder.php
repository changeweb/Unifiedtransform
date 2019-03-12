<?php

use Illuminate\Database\Seeder;

class IssuedbooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Issuedbook::class, 5)->create();
    }
}
