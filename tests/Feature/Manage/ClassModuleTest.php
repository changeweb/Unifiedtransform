<?php

namespace Tests\Feature\Manage;

use App\User;
use App\Myclass;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClassModuleTest extends TestCase
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
    public function it_shows_the_class_list() {
        $this->get('school/sections')
            ->assertStatus(200)
            ->assertViewHas('classes');
    }

    /** @test */
    public function admin_can_create_class() {
        $class = factory(Myclass::class)->make();
        $this->followingRedirects()
            ->post('school/add-class', $class->toArray())
            ->assertStatus(200);

        $this->assertDatabaseHas('classes', $class->toArray());

        $this->get('settings')
            ->assertSee('Manage '.$class['class_number']);
    }
}
