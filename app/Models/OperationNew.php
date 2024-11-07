<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationNew extends Model
{
    use HasFactory;
    protected $table = 'operation_new';
    public $timestamps = true;

    protected $fillable = [
        'project_no', 'purchase_order_no', 'respondent_incentives', 'team_leader', 'project_manager_name', 
        'quality_analyst_name', 'project_deliverable', 'questionnarie', 'other_document', 'survey_link', 
        'country_name', 'sample_target', 'sample_achieved', 'user_id', 
    ];
    public function operationNewImage()
     {
        return $this->hasMany(operationImage::class, 'operation_id','id');
     }
}
