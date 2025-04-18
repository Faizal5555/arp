<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctornotification extends Model
{
    use HasFactory;
    protected $table = 'doctornotification';
    public $timestamps = true;
    protected $fillable = ['user_type','user_id','status'];
}
