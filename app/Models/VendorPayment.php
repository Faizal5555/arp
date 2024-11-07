<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorPayment extends Model
{
    use HasFactory;
    protected $table = 'vendor_payment_received';
    public $timestamps = true;
    protected $fillable = ['transaction_number','payment_date','bank_name','vendor_id'];

    public function client()
    {
        return $this->hasOne(Vendorrequestadvance::class,'id','vendor_id');
    }
}
