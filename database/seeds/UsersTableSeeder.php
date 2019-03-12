<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "hasib",
            'email' => 'hasib@unifiedtransform.com',
            'password' => bcrypt('secret'),
            'role' => 'master',
            'active' => 1,
            'verified' => 1,
        ]);
        //factory(App\User::class, 200)->create();
    }
}
