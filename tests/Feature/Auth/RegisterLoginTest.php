<?php

namespace Tests\Feature\Auth;

use App\School;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterLoginTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();
        $this->password = 'secret';

        $this->school = factory(School::class)->create();

        $this->classData = [
            'class_number' => 1,
            'school_id' => $this->school->id,
            'group' => '',
        ];

        $this->myclass = \App\Myclass::create($this->classData)->first();

        $this->sectionData = [
            'section_number' => 'B',
            'room_number' => 302,
            'class_id' => $this->myclass->id,
        ];

        $this->section = \App\Section::create($this->sectionData)->first();
        
        $this->userData = [
            'name' => 'userName',
            'email' => 'user@unifiedtransform.com',
            'password' => bcrypt($this->password),
            'role' => 'user',
            'active' => 1,
            'verified' => 1,
            'school_id' => $this->school->id,
            'section_id' => $this->section->id,
            'code' => $this->school->code,
            'student_code' => 1234567,
        ];
    }
    /**
     * Unauthenticated User can't view a register form.
     *
     * @return void
     */
    public function test_unauthenticated_user_cannot_view_a_register_form(){
        $response = $this->get('/register');
        $response->assertStatus(302);
    }
    /**
     * User account can be created.
     *
     * @return void
     */
    public function test_user_can_be_created(){
        $this->user = \App\User::create($this->userData)->first();
        
        $this->assertEquals($this->userData['role'], $this->user->role);
    }
    /**
     * User can view a login form.
     *
     * @return void
     */
    public function test_user_Can_view_a_login_form(){
        $response = $this->get('/login');
        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }
    /**
     * User can log in.
     *
     * @return void
     */
    public function test_user_Can_log_in(){
        $this->user = \App\User::create($this->userData)->first();

        $response = $this->post('/login', [
            'email' => $this->user->email,
            'password' => $this->password,
        ]);
        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($this->user);
    }
}
