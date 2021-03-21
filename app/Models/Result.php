<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'event_id',
        'male',
        'female',
        'remainder',
    ];
}
