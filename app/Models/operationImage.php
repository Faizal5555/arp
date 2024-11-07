<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class operationImage extends Model
{
    use HasFactory;
    protected $table = 'operation_images';
    public $timestamps = true;
    protected $fillable = [
        'operation_id','other_documents',
    ];

        
}
