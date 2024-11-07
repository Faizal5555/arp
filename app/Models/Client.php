<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'client';
    public $timestamps = true;

    protected $fillable = [
        'client_name','client_country','client_email','client_manager','client_phoneno','client_whatsapp','user_id'
    ];
}
