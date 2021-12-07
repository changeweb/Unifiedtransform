<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Attendance;
use App\Interfaces\AttendanceInterface;

class AttendanceRepository implements AttendanceInterface {
    public function saveAttendance($request) {
        try {
            $input = $this->prepareInput($request);
            Attendance::insert($input);
        } catch (\Exception $e) {
            throw new \Exception('Failed to save attendance. '.$e->getMessage());
        }
    }

    public function prepareInput($request) {
        $input = [];
        $now = Carbon::now()->toDateTimeString();
        for($i=0; $i < sizeof($request['student_ids']); $i++) {
            $student_id = $request['student_ids'][$i];
            $input[] = array(
                'status'        => (isset($request['status'][$student_id]))?$request['status'][$student_id]:'off',
                'class_id'      => $request['class_id'],
                'student_id'    => $student_id,
                'section_id'    => $request['section_id'],
                'course_id'     => $request['course_id'],
                'session_id'    => $request['session_id'],
                'created_at'    => $now,
                'updated_at'    => $now,
            );
        }
        return $input;
    }

    public function getSectionAttendance($class_id, $section_id, $session_id) {
        try {
            return Attendance::with('student')
                            ->where('class_id', $class_id)
                            ->where('section_id', $section_id)
                            ->where('session_id', $session_id)
                            ->whereDate('created_at', '=', Carbon::today())
                            ->get();
        } catch (\Exception $e) {
            throw new \Exception('Failed to get attendances. '.$e->getMessage());
        }
    }

    public function getCourseAttendance($class_id, $course_id, $session_id) {
        try {
            return Attendance::with('student')
                            ->where('class_id', $class_id)
                            ->where('course_id', $course_id)
                            ->where('session_id', $session_id)
                            ->whereDate('created_at', '=', Carbon::today())
                            ->get();
        } catch (\Exception $e) {
            throw new \Exception('Failed to get attendances. '.$e->getMessage());
        }
    }

    public function getStudentAttendance($session_id, $student_id) {
        try {
            return Attendance::with(['section','course'])
                            ->where('student_id', $student_id)
                            ->where('session_id', $session_id)
                            ->get();
        } catch (\Exception $e) {
            throw new \Exception('Failed to get attendances. '.$e->getMessage());
        }
    }
}