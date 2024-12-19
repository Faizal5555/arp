<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\datacenternew;
use App\Models\Que;

class Incentive extends Model
{
    use HasFactory;

    public function datacenternews()
{
    return $this->belongsTo(datacenternew::class, 'datacenter_id');
}

public function ques()
{
    return $this->belongsTo(Que::class, 'que_id');
}
}
