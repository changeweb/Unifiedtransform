<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersExcelExportTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() {
        parent::setUp();
        $admin = factory(User::class)->states('admin')->create();
        $this->actingAs($admin);
        $this->withoutExceptionHandling();
    }
    /**
     * @test
     *
     * @return void
     */
    public function admin_can_download_students_list()
    {
        $year = now()->year;

        $this->get('users/export/students-xlsx',['year'=>$year,'type'=>'student'])
            ->assertStatus(200);
    }
    /**
     * @test
     *
     * @return void
     */
    public function admin_can_download_teachers_list()
    {
        $year = now()->year;

        $this->get('users/export/students-xlsx',['year'=>$year,'type'=>'teacher'])
            ->assertStatus(200);
    }

    /**
     * @test
     */
    public function non_admin_users_can_not_see_export_users_forms(){
        $librarian = factory(User::class)->states('librarian')->create();
        $this->actingAs($librarian);

        $response = $this->get(url('/users', [$librarian->school_id, '1/0']));
        $response->assertDontSee('Export in Excel by Year');
    }
}
