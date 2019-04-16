<?php

namespace Tests\Unit\App;

use App\Section;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SectionTest extends TestCase
{
    use RefreshDatabase;

    protected $section;

    public function setUp() {
        parent::setUp();
        $this->section = create(Section::class);
    }

    /** @test */
    public function a_section_is_an_instance_of_Section() {
        $this->assertInstanceOf('App\Section', $this->section);
    }

    /** @test */
    public function a_section_belongs_to_class() {
        $this->assertInstanceOf('App\Myclass', $this->section->class);
    }
}
