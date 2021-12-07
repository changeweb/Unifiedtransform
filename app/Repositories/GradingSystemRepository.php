<?php

namespace App\Repositories;

use App\Models\GradingSystem;

class GradingSystemRepository {
    public function store($request) {
        try {
            GradingSystem::create($request);
        } catch (\Exception $e) {
            throw new \Exception('Failed to create grading system. '.$e->getMessage());
        }
    }

    public function getAll($session_id) {
        return GradingSystem::with(['semester', 'schoolClass'])
                    ->where('session_id', $session_id)
                    ->get();
    }

    public function getGradingSystem($session_id, $semester_id, $class_id) {
        return GradingSystem::with(['semester', 'schoolClass'])
                    ->where('session_id', $session_id)
                    ->where('semester_id', $semester_id)
                    ->where('class_id', $class_id)
                    ->first();
    }
}