<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adminvoucher extends Model
{
    use HasFactory;
    protected $table ='adminvouchers';
    public $timestamps = true;
    protected $fillable = [
        'money', 'docter_id', 'status','user_id',
     ];
}
