<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectsComments extends Model
{
    use HasFactory;
    protected $table = 'projects_comments';
    public $timestamps = true;

    protected $fillable = [
       'comments', 'user_id', 'rfq_no'
    ];
    public function getRfq()
    {
        return $this->belongsTo(Bidrfq::class,'rfq_no','id');
    }
}
