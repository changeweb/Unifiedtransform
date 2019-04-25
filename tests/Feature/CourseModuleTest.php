<?php

namespace Tests\Feature;

use App\User;
use App\School;
use App\Section;
use App\Course;
use App\Exam;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourseModuleTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() {
        parent::setUp();
        $admin = factory(User::class)->states('admin')->create();
        $this->actingAs($admin);
        $this->withoutExceptionHandling();
    }
    /** @test */
    public function admin_or_teacher_can_view_courses_by_teacher_id(){
        $teacher = factory(User::class)->states('teacher')->create();
        $response = $this->get('courses/'.$teacher->id.'/0');
        $response->assertStatus(200);
        $response->assertViewIs('course.teacher-course');
        $response->assertViewHas(['courses','exams']);
    }
    /** @test */
    public function admin_or_teacher_can_view_courses_by_section_id(){
        $section = factory(Section::class)->create();
        $response = $this->get('courses/0/'.$section->id);
        $response->assertStatus(200);
        $response->assertViewIs('course.class-course');
        $response->assertViewHas(['courses','exams']);
    }
    /** @test */
    public function can_view_students_from_grade_table_by_course_and_exam(){
        $teacher = factory(User::class)->states('teacher')->create();
        $section = factory(Section::class)->create();
        $course = factory(Course::class)->create();
        $exam = factory(Exam::class)->create();
        $response = $this->get('course/students/'.$teacher->id.'/'.$course->id.'/'.$exam->id.'/'.$section->id);
        $response->assertStatus(200);
        $response->assertViewIs('course.students');
        $response->assertViewHas(['students','teacher_id','section_id']);
    }
    /** @test */
    public function admin_can_add_course(){
        $course = factory(Course::class)->make();
        $response = $this->followingRedirects()->post('courses/store',$course->toArray());
        $response->assertStatus(200);
    }
    /** @test */
    public function admin_can_save_course_configuration(){
        $course = factory(Course::class)->create();
        $response = $this->followingRedirects()->post('courses/save-configuration',$course->toArray());
        $response->assertStatus(200);
    }
}
