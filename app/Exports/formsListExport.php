<?php 

namespace App\Exports;

use App\Users;
use App\Section;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use \Maatwebsite\Excel\Sheet;
use Maatwebsite\Excel\Concerns\WithTitle;

class formsListExport implements WithEvents, WithTitle
{
    private $form_id;

    public function __construct(int $section_id)
    {
        $this->section_id = $section_id;
    }

    public function title(): string
    {
        $formRec = Section::find($this->section_id);
        return $formRec->class->class_number.$formRec->section_number;
    }

    public function registerEvents(): array
    {
        return [];
    }
}



?>
