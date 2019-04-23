<?php

namespace Tests\Feature\Manage;

use App\Course;
use App\Section;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourseModuleTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function setUp() {
        parent::setUp();
        $admin = factory(User::class)->states('admin')->create();
        $this->actingAs($admin);
        $this->withoutExceptionHandling();
        $this->section = factory(Section::class)->create();
    }
    /** @test */
    public function view_is(){
         $this->get('courses/0/'.$this->section->id)
            ->assertViewIs('course.class-course');
    }
    /** @test */
    public function it_shows_the_course_list() {
        $this->get('courses/0/'.$this->section->id)
            ->assertStatus(200)
            ->assertViewHas('courses');
    }
    /** @test */
    public function admin_can_create_course() {
        $teacher = factory(User::class)->states('teacher')->create();
        $course = [
            'course_name' => $this->faker->sentence,
            'class_id' => $this->section->class->id,
            'course_type' => $this->faker->name,
            'course_time' => $this->faker->sentence,
            'section_id' => $this->section->id,
            'teacher_id' => $teacher->id
        ];
        $this->followingRedirects()
            ->post('courses/store', $course)
            ->assertStatus(200);

        $this->assertDatabaseHas('courses', $course);
        
        $this->get('courses/0/'.$this->section->id)
            ->assertSee($course['course_name']);
    }
}
