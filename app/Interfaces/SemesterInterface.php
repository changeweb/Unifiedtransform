<?php

namespace App\Interfaces;

interface SemesterInterface {
    public function create($request);

    public function getAll($session_id);
}