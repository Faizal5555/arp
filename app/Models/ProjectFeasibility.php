<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectFeasibility extends Model
{
    use HasFactory;
    protected $table = 'project_feasibility';

    protected $fillable = [
        'date',
        'pn_number',
        'email_subject_line',
        'project_launch_date',
        'target_countries',
        'responded_title',
        'no_of_sample_required',
        'no_of_sample_delivered',
        'incentive_promised',
        'responded_emails',
    ];
}