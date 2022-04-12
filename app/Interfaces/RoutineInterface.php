<?php

namespace App\Interfaces;

interface RoutineInterface {
    public function saveRoutine($request);

    public function getAll($class_id, $section_id, $session_id);
}