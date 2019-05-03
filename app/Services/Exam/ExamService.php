<?php
namespace App\Services\Exam;

use App\Exam;
use App\Course;
use App\Myclass;
use App\ExamForClass;

class ExamService {
    public $examIds;
    public $request;
    public $exam;

    public function getLatestExamsBySchoolIdWithPagination(){
        return Exam::where('school_id', auth()->user()->school_id)
                ->latest()
                ->paginate(100);
    }

    public function getActiveExamsBySchoolId(){
        return Exam::where('school_id', auth()->user()->school_id)
                    ->where('active',1)
                    ->get();
    }

    public function getCoursesByExamIds(){
        return Course::with('class','teacher')
                    ->whereIn('exam_id', $this->examIds)
                    ->orderBy('class_id')
                    ->get();
    }

    public function getClassesBySchoolId(){
        return Myclass::where('school_id',auth()->user()->school->id)->get();
    }

    public function getAlreadyAssignedClasses(){
        $classes = $this->getClassesBySchoolId()
                        ->pluck('id')
                        ->toArray();
        return ExamForClass::with('exam')
                            ->where('active', 1)
                            ->whereIn('class_id', $classes)
                            ->get();
    }

    public function createExam(){
        $exam = new Exam;
        $exam->exam_name = $this->request->exam_name;
        $exam->active = 1;
        $exam->term = $this->request->term;
        $exam->start_date = $this->request->start_date;
        $exam->end_date = $this->request->end_date;
        $exam->notice_published = 0;
        $exam->result_published = 0;
        $exam->school_id = auth()->user()->school_id;
        $exam->user_id = auth()->user()->id;
        $exam->save();
        return $exam;
    }

    public function updateCoursesWithExamId(){
        Course::whereIn('class_id',$this->request->classes)->update([
            'exam_id' => $this->exam->id
        ]);
    }

    public function assignClassesToExam(){
        $tc = count($this->request->classes);
        $i = 0;
        while($i < $tc){
            $examForClass = new ExamForClass;
            $examForClass->exam_id = $this->exam->id;
            $examForClass->class_id = $this->request->classes[$i];
            $efc[] = $examForClass->attributesToArray();
            ++$i;
        }
        return $efc;
    }

    public function storeExam(){
        \DB::transaction(function () {
            $this->exam = $this->createExam();
        
            // Assign Exam ID to Classes in Course Table
            $this->updateCoursesWithExamId();

            $efc = $this->assignClassesToExam();
            
            if(count($efc) > 0)
                ExamForClass::insert($efc);
        }, 5);
    }

    public function updateExamFields(){
        $tb = Exam::find($this->request->exam_id);
        $tb->notice_published = isset($this->request->notice_published)?1:0;
        $tb->result_published = isset($this->request->result_published)?1:0;
        $tb->active = (isset($this->request->active))?1:0;
        $tb->save();
    }

    public function updateExamForClass(){
        if(!isset($this->request->active)){
            ExamForClass::where('exam_id', $this->request->exam_id)->update(['active'=>0]);
        }
    }

    public function updateExam(){
        \DB::transaction(function () {
            $this->updateExamFields();
            $this->updateExamForClass();
        });
    }
}