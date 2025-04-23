<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessResearch extends Model
{
    use HasFactory;

    protected $table = 'business_research';

    protected $fillable = [
        'user_id', 'date', 'pn_number', 'subject_line', 'client_name', 'industry', 'others','attachments','target_respondent','target_countries','end_date','feasibility_done',
    ];

    // public function teamMembers()
    // {
    //     return $this->belongsToMany(User::class, 'business_team_members', 'business_research_id', 'user_id');
    // }
    public function teamMembers()
{
    return $this->hasMany(BusinessTeamMember::class, 'business_research_id');
}

public function questions()
{
    return $this->hasMany(BusinessResearchQuestion::class);
}



}
