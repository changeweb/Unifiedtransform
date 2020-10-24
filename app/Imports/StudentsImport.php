<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class StudentsImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new FirstStudentSheetImport()
        ];
    }
}
