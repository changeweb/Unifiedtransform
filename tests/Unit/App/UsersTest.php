<?php

namespace Tests\Unit\App;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersTest extends TestCase
{
    use RefreshDatabase;
    protected $user;

    public function setUp() {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function a_user_is_an_instance_of_User() {
        $this->assertInstanceOf('App\User', $this->user);
    }

    /** @test */
    public function a_user_belongs_to_section() {
        $this->assertInstanceOf('App\Section', $this->user->section);
    }
}
