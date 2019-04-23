<?php

namespace Tests\Feature\Manage;

use App\User;
use App\Exam;
use App\School;
use App\Myclass;
use App\Section;
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
    public function view_is(){
         $this->get('exams')
            ->assertViewIs('exams.all');
    }
    /** @test */
    public function it_shows_the_exam_list() {
        $this->get('exams')
            ->assertStatus(200)
            ->assertViewHas('exams');
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
        $this->followingRedirects()
            ->post('exams/create', $request)
            ->assertStatus(200);

        $this->assertDatabaseHas('exams', $exam);
        
        $this->get('exams')
            ->assertSee($exam['exam_name']);
    }
}
