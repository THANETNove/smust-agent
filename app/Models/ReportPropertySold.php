<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportPropertySold extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_product',
        'report',
        'user_id'
    ];
}