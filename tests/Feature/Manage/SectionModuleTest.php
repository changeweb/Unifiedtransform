<?php

namespace Tests\Feature\Manage;

use App\Section;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SectionModuleTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() {
        parent::setUp();
        $admin = factory(User::class)->states('admin')->create();
        $this->actingAs($admin);
        $this->withoutExceptionHandling();
    }
    /** @test */
    public function view_is(){
         $this->get('school/sections')
            ->assertViewIs('school.sections');
    }
    /** @test */
    public function it_shows_the_section_list() {
        $this->get('school/sections')
            ->assertStatus(200)
            ->assertViewHas('sections');
    }
    /** @test */
    public function admin_can_create_section() {
        $section = factory(Section::class)->make();
        $this->followingRedirects()
            ->post('school/add-section', $section->toArray())
            ->assertStatus(200);

        $this->assertDatabaseHas('sections', $section->toArray());

        $this->get('settings')
            ->assertSee('Section '.$section['section_number']);
    }
}
