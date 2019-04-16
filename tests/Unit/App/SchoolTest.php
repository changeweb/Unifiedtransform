<?php

namespace Tests\Unit\App;

use App\School;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SchoolTest extends TestCase
{
    use RefreshDatabase;

    protected $school;

    public function setUp() {
        parent::setUp();
        $this->school = create(School::class);
    }

    /** @test */
    public function a_school_is_an_instance_of_School() {
        $this->assertInstanceOf('App\School', $this->school);
    }

    /** @test */
    public function a_school_has_users() {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection', $this->school->users
        );
    }

    /** @test */
    public function a_school_has_departments() {
        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection', $this->school->departments
        );
    }

}

