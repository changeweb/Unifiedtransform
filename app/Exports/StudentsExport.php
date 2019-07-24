<?php

namespace App\Exports;

use App;
use App\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class StudentsExport implements FromQuery,ShouldAutoSize,WithHeadings
{
    private $headings = [
        'Name', 
        'Email',
        'Phone Number',
        'Gender',
        'Student Code',
        'Blood Group',
        'Section',
        'Class',
        'Address'
    ];

    private $headingsES = [ //for spanish
        'Nombre', 
        'Correo',
        'Tefelono',
        'Genero',
        'Matricula',
        'Grupo sanguineo',
        'Seccion',
        'Clase',
        'Dirección'
    ];

    public function __construct(int $year){
        $this->year = $year;
    }
    
    public function query()
    {
        return User::query()->select('users.name','users.email','users.phone_number','users.gender','users.student_code','users.blood_group','sections.section_number','classes.class_number','users.address')
                    ->where('users.school_id', auth()->user()->school_id)
                    ->where('users.role','student')
                    ->whereYear('users.created_at', $this->year)
                    ->join('sections','sections.id', '=', 'users.section_id')
                    ->join('classes','sections.class_id', '=', 'classes.id')
                    ->orderBy('users.name');
    }

    public function headings() : array
    {
		$myLocale = App::getLocale(); 
		if ($myLocale == "es-MX") {
			return $this->headingsES; //spanish
		} else {
			return $this->headings;	//english
		}
    }
}
