<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class doctorDocuments extends Model
{
    use HasFactory;
    protected $table = 'doctors_documents';
    public $timestamps = true;
    protected $fillable = [
        'document','document_path','document_type', 'doctor_id',
    ];
}
