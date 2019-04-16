<?php

namespace Tests\Unit\App;

use App\Gradesystem;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GradesystemTest extends TestCase
{
    use RefreshDatabase;

    protected $gradesystem;

    public function setUp() {
        parent::setUp();
        $this->gradesystem = create(Gradesystem::class);
    }

    /** @test */
    public function a_gradesystem_is_an_instance_of_Gradesystem() {
        $this->assertInstanceOf('App\Gradesystem', $this->gradesystem);
    }

    /** @test */
    public function a_gradesystem_belongs_to_school() {
        $this->assertInstanceOf('App\School', $this->gradesystem->school);
    }
}
