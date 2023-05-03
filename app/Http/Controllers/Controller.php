<?php

namespace App\Http\Controllers;

use App\Interfaces\SchoolSessionInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $schoolSession;

    protected function __construct(SchoolSessionInterface $schoolSession) {
        $this->schoolSession = $schoolSession;
    }
}
