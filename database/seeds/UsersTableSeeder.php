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
            'name'     => "hasib",
            'email'    => 'hasib@unifiedtransform.com',
            'password' => bcrypt('secret'),
            'role'     => 'master',
            'active'   => 1,
            'verified' => 1,
        ]);

        factory(App\User::class, 10)->states('admin')->create();
        factory(App\User::class, 10)->states('accountant')->create();
        factory(App\User::class, 10)->states('librarian')->create();
        factory(App\User::class, 30)->states('teacher')->create();
        factory(App\User::class, 40)->states('student')->create();
    }
}
