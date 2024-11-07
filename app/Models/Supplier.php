<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'supplier';
    public $timestamps = true;
    protected $fillable=[
        'rfq_no',
        'supplier_company',
        'supplier_manager',
        'supplier_email',
        'supplier_phone',
        'supplier_whatsapp',
        'supplier_country',
        'other_detail',
        'email_content',
        'user_id'
    ];
        public function supplieremailcontent()
        {
            return $this->belongsTo(supplieremailcontent::class, 'id', 'supplier_id');
        }
}
