<?php

namespace App\Repositories;

use App\Models\Exam;
use App\Models\Mark;
use App\Models\FinalMark;
use App\Interfaces\MarkInterface;

class MarkRepository implements MarkInterface {
    public function create($rows) {
        try {
            foreach($rows as $row){
                Mark::updateOrCreate([
                    'exam_id' => $row['exam_id'],
                    'student_id' => $row['student_id'],
                    'session_id' => $row['session_id'],
                    'class_id' => $row['class_id'],
                    'section_id' => $row['section_id'],
                    'course_id' => $row['course_id']
                ],['marks' => $row['marks']]);
            }
        } catch (\Exception $e) {
            throw new \Exception('Failed to update students marks. '.$e->getMessage());
        }
    }

    public function getAll($session_id, $semester_id, $class_id, $section_id, $course_id) {
        $exam_ids = Exam::where('semester_id', $semester_id)->pluck('id')->toArray();
        return Mark::with('student','exam')->where('session_id', $session_id)
                    ->whereIn('exam_id', $exam_ids)
                    ->where('class_id', $class_id)
                    ->where('section_id', $section_id)
                    ->where('course_id', $course_id)
                    ->get();
    }

    public function getAllByStudentId($session_id, $semester_id, $class_id, $section_id, $course_id, $student_id) {
        $exam_ids = Exam::where('semester_id', $semester_id)->pluck('id')->toArray();
        return Mark::with('student','exam')->where('session_id', $session_id)
                    ->whereIn('exam_id', $exam_ids)
                    ->where('student_id', $student_id)
                    ->where('class_id', $class_id)
                    ->where('section_id', $section_id)
                    ->where('course_id', $course_id)
                    ->get();
    }

    public function getFinalMarksCount($session_id, $semester_id, $class_id, $section_id, $course_id) {
        return FinalMark::where('session_id', $session_id)
                    ->where('semester_id', $semester_id)
                    ->where('class_id', $class_id)
                    ->where('section_id', $section_id)
                    ->where('course_id', $course_id)
                    ->count();
    }

    public function getAllFinalMarks($session_id, $semester_id, $class_id, $section_id, $course_id) {
        return FinalMark::with('student')->where('session_id', $session_id)
                    ->where('semester_id', $semester_id)
                    ->where('class_id', $class_id)
                    ->where('section_id', $section_id)
                    ->where('course_id', $course_id)
                    ->get();
    }

    public function getAllFinalMarksByStudentId($session_id, $student_id, $semester_id, $class_id, $section_id, $course_id) {
        return FinalMark::with('student')->where('session_id', $session_id)
                    ->where('student_id', $student_id)
                    ->where('semester_id', $semester_id)
                    ->where('class_id', $class_id)
                    ->where('section_id', $section_id)
                    ->where('course_id', $course_id)
                    ->get();
    }

    public function storeFinalMarks($rows) {
        try {
            foreach($rows as $row){
                FinalMark::updateOrCreate([
                    'semester_id' => $row['semester_id'],
                    'student_id' => $row['student_id'],
                    'session_id' => $row['session_id'],
                    'class_id' => $row['class_id'],
                    'section_id' => $row['section_id'],
                    'course_id' => $row['course_id']
                ],[
                    'calculated_marks' => $row['calculated_marks'],
                    'final_marks' => $row['final_marks'],
                    'note'  => $row['note'],
                ]);
            }
        } catch (\Exception $e) {
            throw new \Exception('Failed to update students final marks. '.$e->getMessage());
        }
    }
}