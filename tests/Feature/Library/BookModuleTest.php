<?php

namespace Tests\Feature;

use App\Book;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookModuleTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() {
        parent::setUp();
        $librarian = factory(User::class)->states('librarian')->create();
        $this->actingAs($librarian);
    }

    /** @test */
    public function it_shows_the_books_list() {
        $books = factory(Book::class, 2)->create();

        $this->get(route('library.books.index'))
            ->assertStatus(200)
            ->assertViewHas('books');
    }

    /** @test */
    public function it_displays_the_books_details() {
        $book = factory(Book::class)->create();

        $this->withoutExceptionHandling();
        $this->get(route('library.books.show', $book->id))
            ->assertStatus(200)
            ->assertSee($book->title);
    }
}
