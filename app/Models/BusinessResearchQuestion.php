<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessResearchQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_research_id',
        'user_id',
        'question',
        'attachment',
        'answer',
    ];
}
