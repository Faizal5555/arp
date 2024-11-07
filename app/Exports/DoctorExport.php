<?php

namespace App\Exports;

use App\Models\datacenternew;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DoctorExport implements FromCollection,WithHeadings
{
    protected $doctor_id;
    
    /**
    * @return \Illuminate\Support\Collection
    */
     function __construct($doctor_id) {
        $this->doctor_id = $doctor_id;
     }
     
    public function collection()
    {
       return datacenternew::where('id',$this->doctor_id)->get([
        'firstname', 'lastname', 'cityname', 'citycode', 
        'PhNumber', 'email', 'whatdsappNumber', 'docterSpeciality', 'totalExperience', 
        'practice', 'licence', 'PatientsMonth','country1'
      ]);
    }
    
     public function headings(): array
    {
        return [
        'Firstname', 'Lastname', 'Cityname', 'Citycode', 
        'PhNumber', 'Email', 'WhatssappNumber', 'DocterSpeciality', 'TotalExperience', 
        'Practice', 'Licence', 'PatientsMonth','Country'
      ];
    }
}
