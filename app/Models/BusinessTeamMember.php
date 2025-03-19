<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class BusinessTeamMember extends Model
{
    use HasFactory;
    protected $table = 'business_team_members';

    protected $fillable = [
        'business_research_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
