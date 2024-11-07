<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientrequest extends Model
{
    use HasFactory;
    protected $table = 'client_advance_request';
    public $timestamps = true;
    protected $fillable = ['rfq','amount','client_contract','client_id','invoice_type','operation_id'];
    
     public function operation()
    {
        return $this->belongsTo(OperationNew::class,'operation_id','id');
    }
}
