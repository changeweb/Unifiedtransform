<?php

namespace Tests\Unit\App;

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
}
