<?php

namespace Tests\Feature\Manage;

use App\User;
use App\Department;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SettingModuleTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() {
        parent::setUp();
        $admin = factory(User::class)->states('admin')->create();
        $this->actingAs($admin);
        $this->withoutExceptionHandling();
    }

    /** @test */
    public function it_shows_the_teachers_list() {
        $this->get(route('settings.index'))
            ->assertStatus(200)
            ->assertViewHas('teachers');
    }

    /** @test */
    public function it_shows_the_departments_list() {
        $this->get(route('settings.index'))
            ->assertStatus(200)
            ->assertViewHas('departments');
    }

    /** @test */
    public function it_shows_the_classes_list() {
        $this->get(route('settings.index'))
            ->assertStatus(200)
            ->assertViewHas('classes');
    }

    /** @test */
    public function it_shows_the_sections_list() {
        $this->get(route('settings.index'))
            ->assertStatus(200)
            ->assertViewHas('sections');
    }

    /** @test */
    public function admin_can_create_new_department() {
        $department = factory(Department::class)->make();
        $this->followingRedirects()
            ->post('school/add-department',$department->toArray())
            ->assertStatus(200);

        $this->assertDatabaseHas('departments',$department->toArray());

        $this->get(route('settings.index'))
            ->assertSee($department['department_name']);
    }
}
