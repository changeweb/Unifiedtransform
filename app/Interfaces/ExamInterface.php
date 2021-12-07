<?php

namespace App\Interfaces;

interface ExamInterface {
    public function create($request);

    public function getAll($session_id, $semester_id, $class_id);
}