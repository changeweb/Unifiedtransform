<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     *
     * Test whether user can view a login form if they visit a login route
     */
    public function user_can_view_a_login_form()
    {
        $response = $this->get('/login');
        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    /**
     * @test
     *
     * Test if user cannot view a login page when they are authenticated(logged In)
     */
    public function user_cannot_view_login_form_when_authenticated()
    {
        $user = User::factory()->make();
        $response = $this->actingAs($user)->get('/login');
        $response->assertRedirect('/home');

    }

    /**
     * @test
     *
     * Test if user can successfully log in with correct credentials
     */
    public function user_can_login_successfully_with_correct_credentials()
    {
        $password = '::password::';
        $user = User::factory()->create([
            'password' => Hash::make($password),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }


    /**
     * @test
     *
     * Test if user cannot log in with incorrect password.
     *
     */
    public function user_cannot_login_with_incorrect_password()
    {
        $password = '::password::';
        $user = User::factory()->create([
            'password' => Hash::make($password),
        ]);

        $response = $this->from('/login')->post('/login', [
            'email' => $user->email,
            'password' => '::incorrect-password::',
        ]);

        $response->assertRedirect('/login');
        $response->assertSessionHasErrors('email');
//        $this->assertAuthenticatedAs($user);
    }
}

