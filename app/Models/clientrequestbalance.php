<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clientrequestbalance extends Model
{
    use HasFactory;
    protected $table = 'client_balance_request';
    public $timestamps = true;
    protected $fillable = ['rfq','client_balance','client_contract','client_id','operation_id'];
}
