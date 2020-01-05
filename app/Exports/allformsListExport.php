<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Myclass;
use App\Section;

class allFormsListExport implements WithMultipleSheets
{
    use Exportable;
    public function sheets(): array
    {
        $sheets = [];
        $year = date("Y");
        // $formList = "";
        $classes = Myclass::query()
            ->bySchool(\Auth::user()->school->id)
            ->pluck('id');
        $sections = Section::with('class')
            ->whereIn('class_id', $classes)
            ->orderBy('class_id', 'asc')
            ->pluck('id');
        // $classes_id = Myclass::with('sections')->where('school_id',\Auth::user()->school->id)
        //     ->orderBy('class_id','asc')->pluck('id');
        foreach($sections as $id){
            $sheets[] = new formsListExport($id);
        }
        return $sheets; 
    }


}


?>
