<?php

use App\User;
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
            'student_code' => 0000000,
            'active'   => 1,
            'verified' => 1,
        ]);

        factory(User::class, 10)->states('admin')->create();
        factory(User::class, 10)->states('accountant')->create();
        factory(User::class, 10)->states('librarian')->create();
        factory(User::class, 30)->states('teacher')->create();
        factory(User::class, 200)->states('student')->create();
    }
}
