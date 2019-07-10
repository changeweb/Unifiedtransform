<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends DuskTestCase
{
    /** @test */
    public function it_shows_app_name() {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('UnifiedTransform');
        });
    }
}
