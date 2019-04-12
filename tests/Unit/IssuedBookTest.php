<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IssuedBookTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A test for inserting each issued book to an array.
     * @dataProvider issued_book_provider
     * @return void
     */
    public function test_insert_each_issued_book_in_an_array(\stdClass $requests, array $expected)
    {
        foreach($requests->book_id as $bk){
          $issueBooks = new \App\Issuedbook;
          $issueBooks->book_id = $bk;
          $issueBooks->student_code = $requests->student_code;
          $issueBooks->quantity = $requests->quantity;
          $issueBooks->school_id = $requests->school_id;//\Auth::user()->school->id;
          $issueBooks->issue_date = $requests->issue_date;
          $issueBooks->return_date = $requests->return_date;
          $issueBooks->fine = $requests->fine;//$request->fine;
          $issueBooks->borrowed = $requests->borrowed;
          $ib[] = $issueBooks->attributesToArray();
        }
        $this->assertSame($ib, $expected);
    }

    public function issued_book_provider(): array{
        $requests = [
                'book_id' => [1023, 3253, 7643],
                'student_code'=>123456,
                'quantity'=>1,
                'school_id'=>1,
                'issue_date'=>date("Y-m-d H:i:s"),
                'return_date'=>date("Y-m-d H:i:s"),
                'fine'=>0,
                'borrowed'=>1
        ];

        $expected = [
            [
                'book_id' => 1023,
                'student_code'=>123456,
                'quantity'=>1,
                'school_id'=>1,
                'issue_date'=>date("Y-m-d H:i:s"),
                'return_date'=>date("Y-m-d H:i:s"),
                'fine'=>0,
                'borrowed'=>1
            ],
            [
                'book_id' => 3253,
                'student_code'=>123456,
                'quantity'=>1,
                'school_id'=>1,
                'issue_date'=>date("Y-m-d H:i:s"),
                'return_date'=>date("Y-m-d H:i:s"),
                'fine'=>0,
                'borrowed'=>1
            ],
            [
                'book_id' => 7643,
                'student_code'=>123456,
                'quantity'=>1,
                'school_id'=>1,
                'issue_date'=>date("Y-m-d H:i:s"),
                'return_date'=>date("Y-m-d H:i:s"),
                'fine'=>0,
                'borrowed'=>1
            ]
        ];
        $requests = json_decode(json_encode($requests), FALSE);
        return [[$requests, $expected]];
    }
}
