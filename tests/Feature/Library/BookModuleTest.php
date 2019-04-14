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

        $this->get(route('library.books.show', $book->id))
            ->assertStatus(200)
            ->assertSee($book->title);
    }

    /** @test */
    public function it_loads_the_new_book_page() {
        $this->get(route('library.books.create'))
            ->assertStatus(200);
    }

    /** @test */
    public function it_creates_a_new_book() {
        $book = factory(Book::class)->make();

        $this->post(route('library.books.store'), $book->toArray())
            ->assertRedirect(route('library.books.show', Book::first()->id));

        $this->assertEquals(1, Book::count());
    }
}
