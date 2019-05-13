<?php

namespace Tests\Unit\App;

use App\School;
use App\Issuedbook;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IssuedBookTest extends TestCase
{
    use RefreshDatabase;

    protected $issuedbook;

    public function setUp() {
        parent::setUp();
        $this->issuedbook = create(Issuedbook::class);
    }

    /** @test */
    public function an_Issuedbook_is_an_instance_of_Issuedbook() {
        $this->assertInstanceOf('App\Issuedbook', $this->issuedbook);
    }

    /** @test */
    public function an_issuedbook_belongs_to_book() {
        $this->assertInstanceOf('App\Book', $this->issuedbook->book);
    }

    /** @test */
    public function the_issued_books_are_filter_by_school() {
        $school = create(School::class);
        $issues = create(Issuedbook::class, ['school_id' => $school->id], 2);

        $other_school = create(School::class);
        $other_issues = create(Issuedbook::class, ['school_id' => $other_school->id], 4);

        $this->assertEquals(Issuedbook::bySchool($school->id)->count(), $issues->count());
    }
}
