<?php

namespace App\Repositories;

use App\Models\Routine;
use App\Interfaces\RoutineInterface;

class RoutineRepository implements RoutineInterface {
    public function saveRoutine($request)
    {
        try{
            Routine::create([
                'start'         => $request['start'],
                'end'           => $request['end'],
                'weekday'       => $request['weekday'],
                'session_id'    => $request['session_id'],
                'class_id'      => $request['class_id'],
                'section_id'    => $request['section_id'],
                'course_id'     => $request['course_id'],
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Failed to save routine. '.$e->getMessage());
        }
    }

    public function getAll($class_id, $section_id, $session_id) {
        return Routine::with('course')
                ->where('session_id', $session_id)
                ->where('class_id', $class_id)
                ->where('section_id', $section_id)
                ->get();
    }
}