<?php

namespace App\Interfaces;

interface AssignedTeacherInterface {
    public function assign($request);

    public function getTeacherCourses($session_id, $teacher_id, $semester_id);

    public function getAssignedTeacher($session_id, $semester_id, $class_id, $section_id, $course_id);
}