<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RfqDetailsTable extends Model
{
    use HasFactory;


    /**
     * Get the user that owns the RfqDetailsTable
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function single()
    {
        return $this->belongsTo(RfqSingleCountry::class, 'id','rfq_details_id');
    }
    public function multiple()
    {
        return $this->belongsTo(RfqMultipleCountry::class, 'id','rfq_details_id');
    }
    public function interview()
    {
        return $this->belongsTo(RfqInterviewDepth::class, 'id','rfq_details_id');
    }
    public function online()
    {
        return $this->belongsTo(RfqOnlineCommunity::class, 'id','rfq_details_id');
    }

    public function operationNew()
    {
        return $this->hasMany(OperationNew::class, 'rfq', 'rfq_no'); // Adjust 'rfq' and 'rfq_no' as needed
    }
}
