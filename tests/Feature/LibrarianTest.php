<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Book;
use App\Issuedbook;

class LibrarianTest extends TestCase
{
    use RefreshDatabase;

    protected $librarian;

    public function setUp() {
        parent::setUp();
        $this->librarian = factory(User::class)->states('librarian')->create();
        $this->actingAs($this->librarian);
        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function can_see_dashboard_as_a_home_page_after_login(){
        $response = $this->get('/home');

        $response->assertStatus(200)
                ->assertSeeText('Dashboard')
                ->assertSeeText(e($this->librarian->name));
    }

    /**
     * @test
     */
    public function can_see_list_of_students(){

        $student = factory(User::class)->states('student')->create();
        $response = $this->get(url('/users', [$this->librarian->school_id, '1/0']));

        $response->assertStatus(200)
                ->assertViewHas('users')
                ->assertSeeText(e($student->name));
    }

    /**
     * @test
     */
    public function can_see_some_personal_student_information(){
        $student = factory(User::class)->states('student')->create();
        $response  = $this->get(url('/user', [$student->student_code]));

        $response->assertStatus(200)
                ->assertSeeText(e($student->name))
                ->assertSeeText(e($student->address))
                ->assertSeeText(e($student->blood_group));
    }

    /**
     * @test
     */
    public function can_see_list_of_teachers(){
        $teacher = factory(User::class)->states('teacher')->create();
        $response = $this->get(url('/users', [$this->librarian->school_id, '0/1']));
        
        $response->assertStatus(200)
                ->assertViewHas('users')
                ->assertSeeText(e($teacher->name));
    }

    /**
     * @test
     */
    public function can_see_some_personal_teacher_information(){
        $teacher = factory(User::class)->states('teacher')->create();
        $response = $this->get(url('/user', [$teacher->student_code]));
        
        $response->assertStatus(200)
                ->assertSeeText(e($teacher->name))
                ->assertSeeText(e($teacher->nationality))
                ->assertDontSeeText('Blood');
    }

    /**
     * @test
     */
    public function can_see_list_of_librarians(){
        $librarian1 = factory(User::class)->states('librarian')->create();
        $librarian2 = factory(User::class)->states('librarian')->create();
        $response = $this->get(url('/users', [$this->librarian->school_id, 'librarian']));

        $response->assertStatus(200)
                ->assertViewHas('users')
                ->assertSeeText(e($librarian1->name))
                ->assertSeeText(e($librarian2->name));
    }

    /**
     * @test
     */
    public function can_see_some_personal_librarian_information(){
        $librarian1 = factory(User::class)->states('librarian')->create();
        $response = $this->get(url('/user', [$librarian1->student_code]));
        
        $response->assertStatus(200)
                ->assertSeeText(e($librarian1->name))
                ->assertSeeText(e($librarian1->nationality))
                ->assertDontSeeText('Blood');
    }

    /**
     * @test
     */
    public function can_see_all_books(){
        $books = factory(Book::class, 4)->create();
        $response = $this->get(route('library.books.index'));

        $response->assertStatus(200)
                ->assertViewHas('books');

        $books->each(function($book) use ($response){
            $response->assertSeeText(e($book->title));
        });
    }

    /**
     * @test
     */
    public function can_see_book_details(){
        $book = factory(Book::class)->create();

        $this->get(route('library.books.show', $book))
            ->assertViewHas('book')
            ->assertSeeText(e($book->title));
    }

    /**
     * @test
     */
    public function can_edit_book_details(){
        $book = factory(Book::class)->create(['title' => 'Foo Bar']);

        $this->get(route('library.books.edit', $book))
            ->assertViewHas('book')
            ->assertSeeText('Update Book Info');
    }

    /**
     * @test
     */
    public function can_see_issued_books(){
        $issuedBook = factory(Issuedbook::class)->create();

        $response = $this->get(route('library.issued-books.index'))
                        ->assertViewHas('issued_books')
                        ->assertSeeText((string) $issuedBook->book_id);
    }

    /**
     * @test
     */
    public function can_add_a_new_book(){
        $this->get(route('library.books.create'))
            ->assertStatus(200)
            ->assertSeeText('Save');
    }
}
