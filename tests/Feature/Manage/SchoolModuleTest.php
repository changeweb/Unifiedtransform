<?php

namespace Tests\Feature\Manage;

use App\School;
use App\Department;
use App\Myclass;
use App\Section;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SchoolModuleTest extends TestCase
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
         $this->get('create-school')
            ->assertViewIs('school.create-school');
    }
    /** @test */
    public function it_shows_the_schools_list() {
        $this->get('create-school')
            ->assertStatus(200)
            ->assertViewHas('schools');
    }
    /** @test */
    public function it_shows_edit_school() {
        $master = factory(User::class)->states('master')->create();
        $this->actingAs($master);
        $this->followingRedirects()
            ->get('school/1')
            ->assertStatus(200)
            ->assertViewHas('school');
    }
    /** @test */
    public function it_shows_the_teachers_list() {
        $this->get('create-school')
            ->assertStatus(200)
            ->assertViewHas('teachers');
    }
    /** @test */
    public function it_shows_the_departments_list() {
        $this->get('create-school')
            ->assertStatus(200)
            ->assertViewHas('departments');
    }
    /** @test */
    public function it_shows_the_classes_list() {
        $this->get('create-school')
            ->assertStatus(200)
            ->assertViewHas('classes');
    }
    /** @test */
    public function it_shows_the_sections_list() {
        $this->get('create-school')
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

        $this->get('create-school')
            ->assertSee($department['department_name']);
    }
}
