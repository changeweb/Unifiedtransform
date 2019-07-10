<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_master_can_sign_in() {
        $user = factory(User::class)->states('master')->create();

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                    ->waitForText('Login')
                    ->type('email', $user->email)
                    ->type('password', 'secret')
                    ->press('Login')
                    ->assertPathIs('/masters');
        });
    }
}
