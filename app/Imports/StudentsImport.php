<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class StudentsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'name'           => $row['name'],
            'email'          => $row['email'],
            'password'       => Hash::make($row['password']),
            'active'         => 1,
            'role'           => 'student',
            'school_id' => auth()->user()->school_id,
            'code' => auth()->user()->code,
            'student_code'   => auth()->user()->school_id.date('y').substr(number_format(time() * mt_rand(), 0, '', ''), 0, 5),
            'address'        => $row['address'],
            'about'          => $row['about'],
            'pic_path'       => '',
            'phone_number'   => $row['phone_number'],
            'verified'       => 1,
            'section_id' => function () {
                if($row['class'] != 0 && $row['section'] != 0){
                    $class_id = Myclass::bySchool()->where()->pluck('id');
                    return Section::where('class_id', $class_id)->pluck('id');
                }
            },
            'blood_group'    => $row['blood_group'],
            'nationality'    => $row['nationality'],
            'gender'         => $row['gender'],
        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function batchSize(): int
    {
        return 200;
    }
}
