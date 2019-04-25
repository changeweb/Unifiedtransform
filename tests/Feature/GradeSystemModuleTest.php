<?php

namespace Tests\Feature;

use App\User, App\Gradesystem;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GradeSystemModuleTest extends TestCase
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
        $response = $this->get('gpa/all-gpa');
        $response->assertStatus(200);
        $response->assertViewIs('gpa.all');
        $response->assertViewHas('gpas');
    }
    /** @test */
    public function admin_can_view_grade_system_create_form(){
        $response = $this->get('gpa/create-gpa');
        $response->assertStatus(200);
    }
    /** @test */
    public function admin_can_create_grade_system(){
        $gradesystem = factory(Gradesystem::class)->make();
        $this->followingRedirects()->post('create-gpa', $gradesystem->toArray())
            ->assertStatus(200);

        $this->assertDatabaseHas('grade_systems', $gradesystem->toArray());
    }
    /** @test */
    public function admin_can_delete_grade_system(){
        $gradesystem = factory(Gradesystem::class)->create();
        $this->followingRedirects()
            ->post('gpa/delete', [
                'gpa_id' => $gradesystem->id
            ])
            ->assertStatus(200);
    }
}
