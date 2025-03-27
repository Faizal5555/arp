<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procompleted extends Model
{
    use HasFactory;
    protected $table = 'project_completed';
    public $timestamps = true;
    protected $fillable=['clientadvance','clientbalance','vendoradvance','vendorbalance','respondentfile','clientinvoicefile','vendorinvoicefile',
                           'client_confirmation','vendor_confirmation','user_id','operation_id'
    ];
}
