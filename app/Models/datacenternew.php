<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class datacenternew extends Model
{
    use HasFactory;
    protected $table = 'datacenternews';
    public $timestamps = true;
    protected $fillable = [
        'firstname', 'lastname', 'cityname', 'citycode', 
        'PhNumber', 'email', 'whatdsappNumber', 'docterSpeciality', 'totalExperience', 
        'practice', 'licence', 'PatientsMonth','country1','date',
    ];
}