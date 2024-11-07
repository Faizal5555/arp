<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendorrequestbalance extends Model
{
    use HasFactory;
    protected $table = 'vendor_request_balance';
    public $timestamps = true;
    protected $fillable = ['rfq','vendor_balance','vendor_contract','vendor_id','operation_id'];
}
