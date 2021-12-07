<?php

namespace App\Interfaces;

interface SchoolSessionInterface {
    public function getLatestSession();

    public function getAll();

    public function getPreviousSession();
    
    public function create($request);

    public function getSessionById($id);

    public function browse($request);
}