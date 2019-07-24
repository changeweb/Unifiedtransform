<?php

namespace App\Exports;

use App;
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

    private $headingsES = [
        'Nombre', 
        'Correo',
        'Genero',
        'Codigo del Maestro',
        'Grupo Sanguineo',
        'Telefono',
        'Dirección',
    ];

    public function __construct(int $year){
        $this->year = $year;
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

    public function query(){
        return User::query()
                    ->select('name','email','gender','student_code','blood_group','phone_number','address')
                    ->bySchool(auth()->user()->school_id)
                    ->where('role','teacher')
                    ->orderBy('name');
    }
}
