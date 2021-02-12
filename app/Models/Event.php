<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;


class Event extends Model
{
    protected $fillable = ['name', 'user_id'];


    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
