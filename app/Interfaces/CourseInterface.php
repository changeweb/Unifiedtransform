<?php

namespace App\Interfaces;

interface CourseInterface {
    public function create($request);

    public function getAll($session_id);

    public function getByClassId($class_id);

    public function findById($course_id);

    public function update($request);
}