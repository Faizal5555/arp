<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientData extends Model
{
    use HasFactory;

    protected $table = 'clientdata';

    protected $fillable = [
        'sr_no',
        'company_name',
        'client_firstname',
        'client_lastname',
        'title',
        'linkedin_id',
        'client_country',
        'phone_number',
        'email_address',
        'comments',
        'followup_date',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
