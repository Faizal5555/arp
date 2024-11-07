<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class doctor_pno extends Model
{
    use HasFactory;
    protected $table = 'doctor_pnos';
    public $timestamps = true;
    protected $fillable = [
        'pno','message','file_upload'
    ];

    public function inboxsend()
    {
        return $this->belongsTo(datacenternew::class,'pno','id');
    }
}
