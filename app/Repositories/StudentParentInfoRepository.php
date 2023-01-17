<?php

namespace App\Repositories;

use App\Models\StudentParentInfo;

class StudentParentInfoRepository
{
    public function store($request, int $studentId)
    {
        try {
            StudentParentInfo::create([
                'student_id' => $studentId,
                'father_name' => $request['father_name'],
                'father_phone' => $request['father_phone'],
                'mother_name' => $request['mother_name'],
                'mother_phone' => $request['mother_phone'],
                'parent_address' => $request['parent_address'],
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Failed to create Student Parent information. ' . $e->getMessage());
        }
    }

    public function getParentInfo(int $studentId)
    {
        return StudentParentInfo::where('student_id', $studentId)->first();
    }

    public function update($request, int $studentId)
    {
        try {
            StudentParentInfo::where('student_id', $studentId)->update([
                'father_name' => $request['father_name'],
                'father_phone' => $request['father_phone'],
                'mother_name' => $request['mother_name'],
                'mother_phone' => $request['mother_phone'],
                'parent_address' => $request['parent_address'],
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Failed to update Student Parent information. ' . $e->getMessage());
        }
    }
}
