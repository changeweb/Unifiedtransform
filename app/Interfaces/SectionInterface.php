<?php

namespace App\Interfaces;

interface SectionInterface {
    public function create($request);

    public function getAllBySession($session_id);

    public function findById($section_id);

    public function getAllByClassId($class_id);

    public function update($request);
}