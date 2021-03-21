<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ResultController extends Controller
{
    public function show($hashed_id)
    {
        //当該イベントの回答を格納
        $event_id = DB::table('events')->where('hashed_id', $hashed_id)->first()->id;
        $answers = DB::table('answers')->where('event_id', $event_id)->get();

        dd($answers[1]->q1);
    }
}
