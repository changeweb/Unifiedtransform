<?php

namespace App\Repositories;

use App\Models\Assignment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Testing\Assert;

class AssignmentRepository {
    public function store($request) {
        // Automatically generate a unique ID for filename...
        $path = Storage::disk('public')->put('assignments', $request['file']);
        try {
            Assignment::create([
                'assignment_name'           => $request['assignment_name'],
                'assignment_file_path'      => $path,
                'teacher_id'                => auth()->user()->id,
                'class_id'                  => $request['class_id'],
                'section_id'                => $request['section_id'],
                'course_id'                 => $request['course_id'],
                'semester_id'               => $request['semester_id'],
                'session_id'                => $request['session_id']
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Failed to create assignment. '.$e->getMessage());
        }
    }

    public function getAssignments($session_id, $course_id) {
        return Assignment::where('course_id', $course_id)
                        ->where('session_id', $session_id)
                        ->get();
    }
}