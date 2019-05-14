<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TeachersExport implements FromQuery,ShouldAutoSize,WithHeadings
{
    private $headings = [
        'Name', 
        'Email',
        'Gender',
        'Teacher Code',
        'Blood Group',
        'Phone Number',
        'Address',
    ];

    public function __construct(int $year){
        $this->year = $year;
    }

    public function headings() : array
    {
        return $this->headings;
    }

    public function query(){
        return User::query()
                    ->select('name','email','gender','student_code','blood_group','phone_number','address')
                    ->bySchool(auth()->user()->school_id)
                    ->where('role','teacher')
                    ->orderBy('name');
    }
}
