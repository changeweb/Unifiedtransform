<?php

namespace Tests\Feature\Auth;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterLoginTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();
    }
    /**
     * Unauthenticated User can't view a register form.
     *
     * @return void
     */
    public function test_unauthenticated_user_cannot_view_a_register_form(){
        $this->get('/register')
            ->assertStatus(302);
    }
    /**
     * User account can be created.
     *
     * @return void
     */
    public function test_user_can_be_created(){
        $master = factory(User::class)->states('master')->create();
        $this->actingAs($master);

        $this->assertDatabaseHas('users', $master->toArray());

        $admin = factory(User::class)->states('admin')->make();
        $this->followingRedirects()
            ->post('register/admin', $admin->toArray())
            ->assertStatus(200);
    }
    /**
     * User can view a login form.
     *
     * @return void
     */
    public function test_user_can_view_a_login_form(){
        $response = $this->get('/login');
        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }
    /**
     * User can log in.
     *
     * @return void
     */
    public function test_user_can_log_in(){
        $user = factory(User::class)->states('admin')->create([
            'password' => bcrypt('secret'),
        ]);

        $this->assertDatabaseHas('users', $user->toArray());
        
        $response = $this->from('/login')->post('/login', [
            'email' => $user->email,
            'password' => 'secret',
        ]);
        
        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }
}
