<?php

namespace Tests\Feature;

use App\User;
use App\Section;
use App\Course;
use App\Exam;
use App\Grade;
use App\Gradesystem;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GradeModuleTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() {
        parent::setUp();
        $teacher = factory(User::class)->states('teacher')->create();
        $this->actingAs($teacher);
        $this->withoutExceptionHandling();
    }
    /** @test */
    public function can_view_classes_sections_for_students_grade(){
        $response = $this->get('grades/all-exams-grade');
        $response->assertStatus(200);
        $response->assertViewIs('grade.all-exams-grade');
        $response->assertViewHas(['classes','sections']);
    }
    /** @test */
    public function can_view_all_students_marks_under_a_section(){
        $section = factory(Section::class)->create();
        $response = $this->get('grades/section/'.$section->id);
        $response->assertStatus(200);
        $response->assertViewIs('grade.class-result');
        $response->assertViewHas('grades');
    }
    /** @test */
    public function can_view_grade_of_a_student(){
        $student = factory(User::class)->states('student')->create();
        $response = $this->get('grades/'.$student->id);
        $response->assertStatus(200);
        $response->assertViewIs('grade.student-grade');
        $response->assertViewHas(['grades','gradesystems','exams']);
    }
    /** @test */
    public function teacher_can_view_students_grades_of_a_section_of_his_course(){
        $teacher = factory(User::class)->states('teacher')->create();
        $course = factory(Course::class)->create();
        $exam = factory(Exam::class)->create();
        $section = factory(Section::class)->create();

        $response = $this->get('grades/t/'.$teacher->id.'/'.$course->id.'/'.$exam->id.'/'.$section->id);
        $response->assertStatus(200);
        $response->assertViewIs('grade.teacher-grade');
        $response->assertViewHas(['grades','gradesystems']);
    }
    /** @test */
    public function teacher_can_submit_students_grades_of_a_section_of_his_course(){
        $teacher = factory(User::class)->states('teacher')->create();
        $course = factory(Course::class)->create();
        $exam = factory(Exam::class)->create();
        $section = factory(Section::class)->create();

        $response = $this->get('grades/c/'.$teacher->id.'/'.$course->id.'/'.$exam->id.'/'.$section->id);
        $response->assertStatus(200);
        $response->assertViewIs('grade.course-grade');
        $response->assertViewHas(['grades','gradesystems','course_id','exam_id','teacher_id']);
    }
    /** @test */
    public function teacher_can_get_total_calculated_marks_of_each_student_of_a_section_of_his_course(){
        $teacher = factory(User::class)->states('teacher')->create();
        $gradeSystem = factory(Gradesystem::class)->create();
        $course = factory(Course::class)->create();
        $exam = factory(Exam::class)->create();
        $section = factory(Section::class)->create();
        factory(Grade::class, 20)->create([
            'exam_id' => $exam->id,
            'course_id' => $course->id,
        ]);
        $request = [
            'teacher_id' => $teacher->id,
            'grade_system_name' => $gradeSystem->grade_system_name,
            'exam_id' => $exam->id,
            'course_id' => $course->id,
            'section_id' => $section->id,
        ];

        $response = $this->post('grades/calculate-marks',$request);
        $response->assertRedirect(route('teacher-grade',[
            'teacher_id' => $teacher->id,
            'course_id' => $course->id,
            'exam_id' => $exam->id,
            'section_id' => $section->id,
        ]));
    }
    /** @test */
    public function teacher_can_save_grade_for_a_section_of_his_course(){
        factory(Grade::class, 3)->create();
        $request = [
            'grade_ids' => [1,2,3],
            'attendance' => [5,4,4],
            'quiz1' => [5,6,9],
            'quiz2' => [6,7,7],
            'quiz3' => [4,6,8],
            'quiz4' => [7,6,9],
            'quiz5' => [5,6,8],
            'assign1' => [5,6,9],
            'assign2' => [6,7,8],
            'assign3' => [9,8,7],
            'ct1' => [5,6,9],
            'ct2' => [6,7,7],
            'ct3' => [4,6,8],
            'ct4' => [7,6,9],
            'ct5' => [5,6,8],
            'written' => [38,56,68],
            'mcq' => [34,56,23],
            'practical' => [12,23,14],
        ];
        $response = $this->followingRedirects()->post('grades/save-grade',$request);
        $response->assertStatus(200);
    }
}
