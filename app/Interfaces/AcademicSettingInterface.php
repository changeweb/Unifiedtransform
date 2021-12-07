<?php

namespace App\Interfaces;

interface AcademicSettingInterface {
    public function getAcademicSetting();
    
    public function updateAttendanceType($request);

    public function updateFinalMarksSubmissionStatus($request);
}