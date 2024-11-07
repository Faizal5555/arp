<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplieremailcontent extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable=[
         "content","file_content","supplier_id"
         ];
    // public function costPerformance()
    // {
    //     return $this->belongsTo(Supplier::class, 'supplier_id','id');
    //  }
}
