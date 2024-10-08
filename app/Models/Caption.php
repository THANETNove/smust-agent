<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caption extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_product',
        'details',
        'user_id'
    ];
}
