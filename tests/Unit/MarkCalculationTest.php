<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MarkCalculationTest extends TestCase
{
    public function marksProvider(): array
    {
        return [
            [[10,8,7,9,5], 27],
            [[9,8,7,8,6], 25],
            [[10,9,6,7,7], 26],
        ];
    }
    /**
     * A basic test for adding highest marks used in method calculateMarks in GradeController.php.
     * @dataProvider marksProvider
     * @return void
     */
    public function test_calculate_marks(array $marks,$expected)
    {
        $markCount = 3;// Take number of e.g. quiz, assignment, class test, etc.
        $markSum = 0;
        $markGradeArray = array();
        for($i=0; $i<5; $i++){
            array_push($markGradeArray,$marks[$i]);
        }
        rsort($markGradeArray);// Sort by highest to lowest
        $largest = array_slice($markGradeArray, 0, $markCount);

        foreach($largest as $q){
            $markSum += $q;
        }
        $this->assertSame($expected, $markSum);
    }
}
