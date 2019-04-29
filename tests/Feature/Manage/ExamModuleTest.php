<?php

namespace Tests\Feature\Manage;

use App\User;
use App\Exam;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExamModuleTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function setUp() {
        parent::setUp();
        $admin = factory(User::class)->states('admin')->create();
        $this->actingAs($admin);
        $this->withoutExceptionHandling();
    }
    /** @test */
    public function it_shows_the_exam_list() {
        $response = $this->get('exams');
        $response->assertStatus(200);
        $response->assertViewIs('exams.all');
        $response->assertViewHas('exams');
    }
    /** @test */
    public function can_view_active_exams_of_a_school(){
        $response = $this->get('exams/active');
        $response->assertStatus(200);
        $response->assertViewIs('exams.active');
        $response->assertViewHas(['exams', 'courses']);
    }
    /** @test */
    public function admin_can_view_exam_creation_form() {
        $response = $this->get('exams/create');
        $response->assertStatus(200);
        $response->assertViewHas('classes');
    }
    /** @test */
    public function admin_can_create_exam() {
        $exam = [
            'exam_name' => $this->faker->words(3, true),
            'term' => $this->faker->sentence,
            'start_date' => $this->faker->dateTime()->format('Y-m-d H:i:s'),
            'end_date' => $this->faker->dateTime()->format('Y-m-d H:i:s'),
        ];
        $classes = [
            'classes' => [1,2,3]//id
        ];
        $request = array_merge($exam, $classes);
        $response = $this->followingRedirects()
                    ->post('exams/create', $request);
        $response->assertStatus(200);

        $this->assertDatabaseHas('exams', $exam);
        
        $response = $this->get('exams');
        $response->assertSee($exam['exam_name']);
    }
    /** @test */
    public function admin_can_activate_exam() {
        $exam = factory(Exam::class)->create();
        $request = [
            'exam_id' => $exam->id,
            'active' => 1,
            'notice_published' => 1,
        ];
        $this->followingRedirects()
                ->post('exams/activate-exam', $request)
                ->assertStatus(200);
        $this->assertDatabaseHas('exams', [
            'active' => 1,
        ]);
    }
    /** @test */
    public function admin_can_deactivate_exam() {
        $exam = factory(Exam::class)->create();
        $request = [
            'exam_id' => $exam->id,
            'notice_published' => 1,
            'result_published' => 1,
        ];
        $this->followingRedirects()
                ->post('exams/activate-exam', $request)
                ->assertStatus(200);
        $this->assertDatabaseHas('exams', [
            'id' => $exam->id,
            'active' => 0,
        ]);
    }
}
