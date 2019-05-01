<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\Grade\GradeService;

class MarkCalculationTest extends TestCase
{
    use RefreshDatabase;

    protected $gradeService;

    public function setUp() {
        parent::setUp();
        $this->gradeService = new GradeService;
    }
    public function marksProvider(): array
    {
        return [
            [[0,10,8,7,9,5], 27],
            [[0,9,8,7,8,6], 25],
            [[0,10,9,6,7,7], 26],
        ];
    }
    /**
     * A basic test for adding highest marks used in method getMarkSum in app/Grade/GradeService.php.
     * @dataProvider marksProvider
     * @test
     * @return void
     */
    public function getMarkSum(array $marks,$expected)
    {
        $this->gradeService->grade = $marks;
        $this->gradeService->field = '';
        $this->gradeService->fieldCount = 3;
        $this->gradeService->maxFieldNum = 5;
        $markSum = $this->gradeService->getMarkSum();
        
        $this->assertSame($expected, $markSum);
    }

    public function fieldFinalMarksProvider(): array
    {
        return [
            [[10, 15, 8.5, 9], 12.75],// Class Test
            [[0, 10, 8.5, 9], 9],// Class Test (No percentage)
            [[5, 5, 4.5, 5], 4.5],// Assignment
        ];
    }
    /** 
     * @dataProvider fieldFinalMarksProvider
     * @test
     */
    public function getFieldFinalMark(array $marks, $expected){
        $this->gradeService->full_field_mark = $marks[0];
        $this->gradeService->field_percentage = $marks[1];
        $this->gradeService->avg_field_sum = $marks[2];
        $this->gradeService->final_default_value = $marks[3];
        $final_mark = $this->gradeService->getFieldFinalMark();
        
        $this->assertSame($expected, $final_mark);
    }

    public function calculatedMarksProvider(): array
    {
        return [
            [[4, 8.5, 8, 7, 40, 20], 87.5],
            [[5, 9, 8.5, 7.5, 45, 18], 93.0],
        ];
    }
    /** 
     * @dataProvider calculatedMarksProvider
     * @test
     */
    public function getTotalCalculatedMarks(array $calculated_marks, $expected){
        $this->gradeService->final_att_mark = $calculated_marks[0];
        $this->gradeService->final_quiz_mark = $calculated_marks[1];
        $this->gradeService->final_assignment_mark = $calculated_marks[2];
        $this->gradeService->final_ct_mark = $calculated_marks[3];
        $this->gradeService->final_finalExam_mark = $calculated_marks[4];
        $this->gradeService->final_practical_mark = $calculated_marks[5];
        $totalMarks = $this->gradeService->getTotalCalculatedMarks();

        $this->assertSame($expected, $totalMarks);
    }
}
