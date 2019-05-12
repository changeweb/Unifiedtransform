<?php

namespace Tests\Unit\App;

use App\Book;
use App\School;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    protected $book;

    public function setUp() {
        parent::setUp();
        $this->book = create(Book::class);
    }

    /** @test */
    public function a_class_is_an_instance_of_Book() {
        $this->assertInstanceOf('App\Book', $this->book);
    }

    /** @test */
    public function a_book_belongs_to_school() {
        $this->assertInstanceOf('App\School', $this->book->school);
    }

    /** @test */
    public function a_book_belongs_to_class() {
        $this->assertInstanceOf('App\Myclass', $this->book->class);
    }

    /** @test */
    public function a_book_belongs_to_user() {
        $this->assertInstanceOf('App\User', $this->book->user);
    }

    /** @test */
    public function the_books_are_filter_by_school() {
        $school = create(School::class);
        $books  = create(Book::class, ['school_id' => $school->id], 2);

        $other_school = create(School::class);
        $other_books  = create(Book::class, ['school_id' => $other_school->id], 4);

        $this->assertEquals(Book::bySchool($school->id)->count(), $books->count());
    }
}
