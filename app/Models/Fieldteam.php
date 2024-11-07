<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fieldteam extends Model
{
    use HasFactory;
    protected $table = 'add_field_team';
    public $timestamps = true;
    protected $fillable = [
        'team_leader', 'project_manager_name', 'quality_analyst_name','user_id',
    ];
}
