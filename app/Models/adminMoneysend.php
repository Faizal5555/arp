<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adminMoneysend extends Model
{
    use HasFactory;
    protected $table = 'admin_moneysends';
    public $timestamps = true;
    protected $fillable = [
        'money', 'docter_id', 'status','user_id',
     ];
     public function user()
     {
        return $this->belongsTo(User::class, 'user_id','id');
     }
     public function datacenternew()
     {
        return $this->belongsTo(datacenternew::class, 'docter_id','id');
     }
}
