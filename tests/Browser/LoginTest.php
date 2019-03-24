<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    
    public function tearDown()
    {
        session()->flush();

        parent::tearDown();
    }
    /**
     * A Dusk test login.
     *
     * @return void
     */
    public function testLogin()
    {
        $user = \App\User::where('role','master')->first();

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                    ->type('email', $user['email'])
                    ->type('password', 'secret')
                    ->press('Login')
                    ->assertPathIs('/home');
        });
    }
}
