<?php

namespace Tests\Unit\App;

use App\User;
use App\School;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp() {
        parent::setUp();
        $this->user = create(User::class);
    }

    /** @test */
    public function an_user_is_an_instance_of_User() {
        $this->assertInstanceOf('App\User', $this->user);
    }

    /** @test */
    public function an_user_belongs_to_section() {
        $this->assertInstanceOf('App\Section', $this->user->section);
    }

    /** @test */
    public function an_user_belongs_to_school() {
        $this->assertInstanceOf('App\School', $this->user->school);
    }

    /** @test */
    public function an_user_belongs_to_department() {
        $this->assertInstanceOf('App\Department', $this->user->department);
    }

    /** @test */
    public function an_user_has_role() {
        $accountant = factory(User::class)->states('accountant')->create();
        $admin      = factory(User::class)->states('admin')->create();
        $librarian  = factory(User::class)->states('librarian')->create();
        $master     = factory(User::class)->states('master')->create();
        $student    = factory(User::class)->states('student')->create();
        $teacher    = factory(User::class)->states('teacher')->create();

        $this->assertTrue($accountant->hasRole('accountant'));
        $this->assertTrue($admin->hasRole('admin'));
        $this->assertTrue($librarian->hasRole('librarian'));
        $this->assertTrue($master->hasRole('master'));
        $this->assertTrue($student->hasRole('student'));
        $this->assertTrue($teacher->hasRole('teacher'));
    }

    /** @test */
    public function the_users_are_filter_by_school() {
        $school = create(School::class);
        $users  = create(User::class, ['school_id' => $school->id], 2);

        $other_school = create(School::class);
        $other_users  = create(User::class, ['school_id' => $other_school->id], 4);

        $this->assertEquals(User::bySchool($school->id)->count(), $users->count());
    }
}
