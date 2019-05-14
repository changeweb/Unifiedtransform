<?php

namespace App\Imports;

use App\User;
use App\StudentInfo;
use App\Myclass;
use App\Section;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FirstStudentSheetImport implements OnEachRow, WithHeadingRow
{
    protected $class, $section;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function onRow(Row $row)
    {   
        $rowIndex = $row->getIndex();

        if($rowIndex >= 200)
            return; // Not more than 200 rows at a time

        $row = $row->toArray();

        $this->class = (string) $row['class'];
        $this->section = (string) $row['section'];

        $user = [
            'name'           => $row['name'],
            'email'          => $row['email'],
            'password'       => Hash::make($row['password']),
            'active'         => 1,
            'role'           => 'student',
            'school_id'      => auth()->user()->school_id,
            'code'           => auth()->user()->code,
            'student_code'   => auth()->user()->school_id.date('y').substr(number_format(time() * mt_rand(), 0, '', ''), 0, 5),
            'address'        => $row['address'],
            'about'          => $row['about'],
            'pic_path'       => '',
            'phone_number'   => $row['phone_number'],
            'verified'       => 1,
            'section_id'     => $this->getSectionId(),
            'blood_group'    => $row['blood_group'],
            'nationality'    => $row['nationality'],
            'gender'         => $row['gender'],
        ];

        $tb = create(User::class, $user);

        $student_info = [
            'student_id'           => $tb->id,
            'session'              => $row['session'] ?? now()->year,
            'version'              => $row['version'] ?? '',
            'group'                => $row['group'] ?? '',
            'birthday'             => $row['birthday']?? date('Y-m-d'),
            'religion'             => $row['religion'] ?? '',
            'father_name'          => $row['father_name'],
            'father_phone_number'  => $row['father_phone_number'] ?? '',
            'father_national_id'   => $row['father_national_id'] ?? '',
            'father_occupation'    => $row['father_occupation'] ?? '',
            'father_designation'   => $row['father_designation'] ?? '',
            'father_annual_income' => $row['father_annual_income'] ?? '',
            'mother_name'          => $row['mother_name'],
            'mother_phone_number'  => $row['mother_phone_number'] ?? '',
            'mother_national_id'   => $row['mother_national_id'] ?? '',
            'mother_occupation'    => $row['mother_occupation'] ?? '',
            'mother_designation'   => $row['mother_designation'] ?? '',
            'mother_annual_income' => $row['mother_annual_income'] ?? '',
            'user_id' => auth()->user()->id,
        ];
        
        create(StudentInfo::class, $student_info);
    }

    public function getSectionId(){
        if(!empty($this->class) && !empty($this->section)){
            $class_id = Myclass::bySchool(auth()->user()->school_id)->where('class_number', $this->class)->pluck('id')->first();

            $section = Section::where('class_id', $class_id)->where('section_number', $this->section)->pluck('id')->first();

            return $section;
        } else {
            return 0;
        }
    }
}
