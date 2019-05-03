<?php

namespace Tests\Feature\Library;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Issuedbook;
use App\Book;

class IssuedBookModuleTest extends TestCase
{
    use RefreshDatabase;

    protected $librarian;

    public function setUp() {
        parent::setUp();
        $this->librarian = factory(User::class)->states('librarian')->create();
        $this->actingAs($this->librarian);
        $this->withoutExceptionHandling();
    }
    /** @test */
    public function librarian_can_issue_books(){
        $request = factory(Issuedbook::class)->make([
            'book_id' => [1,2,3,4,5]
        ]);
        $this->followingRedirects()->post('library/issue-books', $request->toArray())
            ->assertStatus(200);
        $this->assertEquals(Issuedbook::count(),count((array)$request->book_id));
    }
}
