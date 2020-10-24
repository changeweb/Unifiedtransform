<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TeachersImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new FirstTeacherSheetImport()
        ];
    }
}
