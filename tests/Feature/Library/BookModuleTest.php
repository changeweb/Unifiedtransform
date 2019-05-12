<?php

namespace Tests\Feature\Library;

use App\Book;
use App\User;
use App\Myclass;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookModuleTest extends TestCase
{
    use RefreshDatabase;

    protected $librarian;

    public function setUp() {
        parent::setUp();
        $this->librarian = factory(User::class)->states('librarian')->create();
        $this->actingAs($this->librarian);
    }

    /** @test */
    public function it_shows_the_books_list() {
        $book = create(Book::class, [], 2);

        $this->get(route('library.books.index'))
            ->assertStatus(200)
            ->assertViewHas('books');
    }

    /** @test */
    public function it_displays_the_books_details() {
        $book = create(Book::class);

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
        $book = make(Book::class);

        $this->post(route('library.books.store'), $book->toArray())
            ->assertRedirect(route('library.books.show', Book::first()->id));

        $this->assertEquals(1, Book::count());
        $this->assertDatabaseHas('books', $book->toArray());
    }

    /** @test */
    public function the_book_attributes_must_be_required() {
        $this->from(route('library.books.create'))
            ->post(route('library.books.store'), [
                'title'     => '',
                'book_code' => '',
                'author'    => '',
                'quantity'  => null,
                'rackNo'    => '',
                'rowNo'     => '',
                'type'      => '',
                'about'     => '',
                'price'     => null,
                'img_path'  => '',
                'class_id'  => null,
                'school_id' => $this->librarian->school_id,
                'user_id'   => $this->librarian->id
            ])
            ->assertRedirect(route('library.books.create'))
            ->assertSessionHasErrors([
                'title', 'book_code', 'author', 'quantity', 'rackNo', 'rowNo',
                'type', 'about', 'price', 'img_path', 'class_id'
            ]);

        $this->assertEquals(0, Book::count());
    }

    /** @test */
    public function the_book_code_must_be_unique() {
        $existent_book = create(Book::class, ['book_code' => 'code_1']);

        $this->from(route('library.books.create'))
            ->post(route('library.books.store'), [
                'title'     => 'title',
                'book_code' => 'code_1',
                'author'    => 'author',
                'quantity'  => 10,
                'rackNo'    => '1',
                'rowNo'     => '2',
                'type'      => 'Dev',
                'about'     => 'about',
                'price'     => 10,
                'img_path'  => 'https://lorempixel.com/150/150/cats/?88202',
                'class_id'  => $existent_book->class_id,
                'school_id' => $this->librarian->school_id,
                'user_id'   => $this->librarian->id
            ])
            ->assertRedirect(route('library.books.create'))
            ->assertSessionHasErrors(['book_code']);

        $this->assertEquals(1, Book::count());
    }

    /** @test */
    public function it_loads_the_edit_book_page() {
        $book = create(Book::class);

        $this->get(route('library.books.edit', $book))
            ->assertStatus(200);
    }

    /** @test */
    public function a_book_can_be_edited()
    {
        $book = create(Book::class, ['title' => 'Original title']);

        $book->title = 'New title';

        $this->from(route('library.books.edit', $book->id))
            ->put(route('library.books.update', $book->id), $book->toArray())
            ->assertRedirect(route('library.books.index'));

        $this->assertDatabaseHas('books', $book->toArray());
    }
}
