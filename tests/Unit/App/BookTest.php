<?php

namespace Tests\Unit\App;

use App\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    protected $book;

    public function setUp() {
        parent::setUp();
        $this->book = factory(Book::class)->create();
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
}
