<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    public $fillable = [
        'user_id',
        'kg',
        'chest_cm',
        'waist_cm',
        'thighs_cm',
        'wrist_cm',
        'neck_cm',
        'biceps_cm',
        'date',
        'mood',
        'hunger',
        'kpdn',
        'sleep'
    ];
}
