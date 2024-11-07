<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendorrequestadvance extends Model
{
    use HasFactory;
    protected $table = 'vendor_request_advance';
    public $timestamps = true;
    protected $fillable = ['rfq','amount','vendor_contract','vendor_id','invoice_type','operation_id'];
    
     public function operation()
    {
        return $this->belongsTo(OperationNew::class,'operation_id','id');
    }
}
