<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\DB;


class AnswerController extends Controller
{
    public function showTop($hashed_id)
    {
        $event = DB::table('events')->where('hashed_id', $hashed_id)->first();
        return view('questions.top', ['event' => $event]);
    }
}
