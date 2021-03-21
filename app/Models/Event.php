<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;


class Event extends Model
{
    protected $fillable = ['name', 'user_id', 'hashed_id', 'outputed'];

    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
