<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidRfq extends Model
{
    use HasFactory;
    protected $table = 'bid-rfq';
    public $timestamps = true;

    protected $fillable = [
        'rfq_no', 'client_id', 'vendor_id','user_id', 'date', 'industry','currency','setup_cost', 'recruitment', 
        'incentives', 'moderation', 'transcript', 'others', 'sample_size', 'country','total_cost','comments','status'
    ];

    public function operationNew()
    {
        return $this->hasMany(OperationNew::class, 'rfq', 'rfq_no'); // Adjust 'rfq' and 'rfq_no' as needed
    }
}
