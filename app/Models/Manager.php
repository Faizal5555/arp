<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory;
    protected $table = 'manager';
    public $timestamps = true;

    protected $fillable = [
        'name', 'address', 'phone_no', 'whatsapp_no', 'photo', 'other_document', 
        'experiance', 'others', 'qualification', 'country', 'email', 'user_id', 
    ];
}
 