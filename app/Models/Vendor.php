<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $table = 'vendor';
    public $timestamps = true;

    protected $fillable = [
        'vendor_name','vendor_country','vendor_email','vendor_manager','vendor_phoneno','vendor_whatsapp','user_id','client_id'
    ];
}
