<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\SettingPage;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminUserManagesAcademicSettingsTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function setUp() {
        parent::setUp();
        $this->admin = factory(User::class)->states('admin')->create();
    }

    /** @test */
    public function admin_user_can_see_academic_settings() {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->admin)
                ->visit(new SettingPage);
        });
    }
}
