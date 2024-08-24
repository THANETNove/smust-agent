<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalWebsite extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'imageHade',
        'provinces',
        'history_work',
        'image_1',
        'name_1',
        'details_1',
        'image_2',
        'name_2',
        'details_2',
        'image_3',
        'name_3',
        'details_3',
    ];
}
