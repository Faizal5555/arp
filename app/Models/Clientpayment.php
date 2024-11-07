<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientpayment extends Model
{
    use HasFactory;
    protected $table = 'client_received_payment';
    protected $fillable = ['transaction_number','date_payment','bank_name','advance_id'];

    public function client()
    {
        return $this->belongsTo(Clientrequest::class,'advance_id','id');
    }
}
