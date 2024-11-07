<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table = 'won_notification';
    public $timestamps = true;

    protected $fillable = [
        'won_id','type','status','rfq_no'
    ];
}
