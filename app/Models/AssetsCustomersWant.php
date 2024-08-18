<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetsCustomersWant extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'sale_rent',
        'property_type',
        'price_start',
        'price_end',
        'provinces',
        'districts',
        'amphures',
        'station',
        'options',
        'message_customer',
        'status',
        'webName',
        'webPhone',
        'webLine',
        'webFacebook'
    ];
}