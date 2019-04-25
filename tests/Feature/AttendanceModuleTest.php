<?php

namespace Tests\Feature;

use App\User;
use App\Section;
use App\Exam;
use App\Attendance;
use App\Course;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AttendanceModuleTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() {
        parent::setUp();
        $admin = factory(User::class)->states('admin')->create();
        $this->actingAs($admin);
        $this->withoutExceptionHandling();
    }
    /** @test */
    public function can_view_student_attendance_by_section(){
        $section = factory(Section::class)->create();
        $exam = factory(Exam::class)->create();
        $response = $this->get('attendances/'.$section->id.'/0/'.$exam->id);
        $response->assertStatus(200);
        $response->assertViewIs('attendance.attendance');
        $response->assertViewHas('attendances');
    }
    /** @test */
    public function can_view_students_by_section(){
        $section = factory(Section::class)->create();
        $response = $this->get('attendances/'.$section->id);
        $response->assertStatus(200);
        $response->assertViewIs('list.student-list');
        $response->assertViewHas('users');
    }
    /** @test */
    public function students_are_added_to_a_section_before_taking_attendance(){
        $teacher = factory(User::class)->states('teacher')->create();
        $section = factory(Section::class)->create();
        $exam = factory(Exam::class)->create();
        $course = factory(Course::class)->create();
        $response = $this->get('attendances/students/'.$teacher->id.'/'.$course->id.'/'.$exam->id.'/'.$section->id);
        $response->assertStatus(200);
        $response->assertViewIs('attendance.attendance');
        $response->assertViewHas([
            'students',
            'attendances',
            'attCount',
            'section_id',
            'exam_id',
        ]);
    }
    /** @test */
    public function view_student_attendance_by_student_id(){
        $student = factory(User::class)->states('student')->create();
        $response = $this->get('attendances/0/'.$student->id.'/0');
        $response->assertStatus(200);
        $response->assertViewIs('attendance.student-attendances');
        $response->assertViewHas('attendances');
    }
    /** @test */
    public function admin_or_teacher_can_view_adjust_student_attendance_form(){
        $student = factory(User::class)->states('student')->create();
        $response = $this->get('attendance/adjust/'.$student->id);
        $response->assertStatus(200);
        $response->assertViewIs('attendance.adjust');
        $response->assertViewHas('attendances');
    }
    /** @test */
    public function admin_or_teacher_can_adjust_student_attendance(){
        $request = [
            'att_id' => [1,3,5],
            'isPresent' => [1,0,1],
        ];
        factory(Attendance::class, 5)->create();
        $response = $this->followingRedirects()->post('attendance/adjust',$request);
        $response->assertStatus(200);
    }
    /** @test */
    public function admin_or_teacher_can_take_students_attendance(){
        $attendances = factory(Attendance::class, 5)->create();
        $request = [
            'students' => [
                $attendances[0]->student_id,
                $attendances[1]->student_id,
                $attendances[2]->student_id,
            ],
            'attendances' => [0],
            'section_id' => $attendances[0]->section_id,
            'exam_id' => $attendances[0]->exam_id,
            'update' => 0,
        ];
        
        $response = $this->followingRedirects()->post('attendance/take-attendance',$request);
        $response->assertStatus(200);
    }
    /** @test */
    public function admin_or_teacher_can_update_students_attendance(){
        $attendances = factory(Attendance::class, 5)->create();
        $request = [
            'students' => [
                $attendances[0]->student_id,
                $attendances[1]->student_id,
                $attendances[2]->student_id,
            ],
            'attendances' => [1,2,3],
            'section_id' => $attendances[0]->section_id,
            'exam_id' => $attendances[0]->exam_id,
            'update' => 1,
        ];
        
        $response = $this->followingRedirects()->post('attendance/take-attendance',$request);
        $response->assertStatus(200);
    }
}
