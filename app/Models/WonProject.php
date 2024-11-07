<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WonProject extends Model
{
    use HasFactory; 
    protected $table = 'won_project';
    public $timestamps = true;

    protected $fillable = [
        'rfq_no','rfq_no_id','project_name','project_type','project_execution','project_start_date','project_end_date',
        'client_total', 'vendor_total', 'client_advance', 'client_balance', 'vendor_advance', 'vendor_balance',
        'client_contract', 'vendor_contract', 'total_margin','date','user_id'
    ];
}
