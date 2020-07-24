<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Certificate;

class CertificateTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void {
        parent::setUp();
        $admin = factory(User::class)->states('admin')->create();
        $this->actingAs($admin);
        $this->withoutExceptionHandling();
    }

    /** @test */
    public function admin_can_view_upload_certificate_page(){
        factory(User::class)->states('student')->create();
        $certificates = factory(Certificate::class, 50)->create();
        $response = $this->get('academic/certificate');
        $response->assertStatus(200)
                ->assertViewIs('certificates.create')
                ->assertViewHas('certificates');
    }

    /** @test */
    public function student_can_view_certificates(){
        factory(User::class)->states('student')->create();
        $certificates = factory(Certificate::class, 50)->create();
        $response = $this->get('academic/student/certificates');
        $response->assertStatus(200)
                ->assertViewIs('certificates.index')
                ->assertViewHas('certificates');
    }
}
