<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class accountregister extends Model
{
    use HasFactory;
    protected $table = 'accountregisters';
    public $timestamps = true;
    protected $fillable = [
        'account_holder_name', 'account_number', 'ifc_code','branch_name',
     ];
}
