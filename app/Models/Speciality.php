<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    use HasFactory;
    protected $table = 'doctor_speciality';
    public $timestamps = true;

    protected $fillable = [
        'speciality'
    ];
}
