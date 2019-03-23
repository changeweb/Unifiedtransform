<?php

namespace Tests\Feature\Auth;

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
        $this->schoolData = [
            'name' => 'School 1',
            'about' => 'First School',
            'medium' => 'english',
            'code' => date("y").substr(number_format(time() * mt_rand(),0,'',''),0,6),
            'theme' => 'flatly',
        ];

        $this->school = \App\School::create($this->schoolData)->first();

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
    public function testUnauthenticatedUserCannotViewARegisterForm(){
        $response = $this->get('/register');
        $response->assertStatus(302);
    }
    /**
     * User account can be created.
     *
     * @return void
     */
    public function testUserCanBeCreated(){
        $this->user = \App\User::create($this->userData)->first();
        
        $this->assertEquals($this->userData['role'], $this->user->role);
    }
    /**
     * User can view a login form.
     *
     * @return void
     */
    public function testUserCanViewALoginForm(){
        $response = $this->get('/login');
        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }
    /**
     * User can log in.
     *
     * @return void
     */
    public function testUserCanLogIn(){
        $this->user = \App\User::create($this->userData)->first();

        $response = $this->post('/login', [
            'email' => $this->user->email,
            'password' => $this->password,
        ]);
        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($this->user);
    }
}
