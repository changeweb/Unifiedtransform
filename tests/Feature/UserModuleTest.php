<?php

namespace Tests\Feature;

use App\User;
use App\School;
use App\Section;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserModuleTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() {
        parent::setUp();
        $admin = factory(User::class)->states('admin')->create();
        $this->actingAs($admin);
        $this->withoutExceptionHandling();
    }
    /** @test */
    public function can_view_students_of_a_school(){
        $school = factory(School::class)->create();
        $response = $this->get('users/'.$school->code.'/1/0');
        $response->assertStatus(200);
        $response->assertViewIs('list.student-list');
        $response->assertViewHas('users');
    }
    /** @test */
    public function can_view_teachers_of_a_school(){
        $school = factory(School::class)->create();
        $response = $this->get('users/'.$school->code.'/0/1');
        $response->assertStatus(200);
        $response->assertViewIs('list.teacher-list');
        $response->assertViewHas('users');
    }
    /** @test */
    public function can_view_accountants_of_a_school(){
        $school = factory(School::class)->create();
        $response = $this->get('users/'.$school->code.'/accountant');
        $response->assertStatus(200);
        $response->assertViewIs('accounts.accountant-list');
        $response->assertViewHas('users');
    }
    /** @test */
    public function can_view_librarians_of_a_school(){
        $school = factory(School::class)->create();
        $response = $this->get('users/'.$school->code.'/librarian');
        $response->assertStatus(200);
        $response->assertViewIs('library.librarian-list');
        $response->assertViewHas('users');
    }
    /** @test */
    public function can_view_students_of_a_section(){
        $section = factory(Section::class)->create();
        $response = $this->get('section/students/'.$section->id);
        $response->assertStatus(200);
        $response->assertViewIs('profile.section-students');
        $response->assertViewHas('students');
    }
    /** @test */
    public function can_view_promote_section_students_form(){
        $section = factory(Section::class)->create();
        $response = $this->get('school/promote-students/'.$section->id);
        $response->assertStatus(200);
        $response->assertViewIs('school.promote-students');
        $response->assertViewHas(['students','classes','section_id',]);
    }
    /** @test */
    public function can_promote_section_students(){
        $section = factory(Section::class)->create();
        $response = $this->get('school/promote-students/'.$section->id);
        $response->assertStatus(200);
        $response->assertViewIs('school.promote-students');
        $response->assertViewHas(['students','classes','section_id',]);
    }
    /** @test */
    public function admin_redirected_to_register_with_register_role_student(){
        $section = factory(Section::class)->create();
        factory(User::class, 5)->states('student')->create([
            'section_id' => $section->id,
        ]);
        $request = [
            'section_id' => $section->id,
            'to_section' => [6,1,3,7,5],
            'to_session' => [2019, 2019, 2019, 2019, 2019],
            'left_school0' => 0,
            'left_school1' => 1,
            'left_school2' => 0,
            'left_school3' => 0,
            'left_school4' => 0,
        ];
        $response = $this->followingRedirects()
                        ->post('school/promote-students', $request);
        $response->assertStatus(200);
    }
}
