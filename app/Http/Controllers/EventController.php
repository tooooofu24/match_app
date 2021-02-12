<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    //イベント一覧
    public function showEvents()
    {
        $user = Auth::user();
        $events = DB::table('events')->where('user_id', $user->id)->get();

        return view('events', ['events' => $events]);
    }
    //イベント詳細
    public function confirmEvent($id)
    {
        $event = DB::table('events')->where('id', $id)->first();

        return view('confirm', ['event' => $event]);
    }

    //イベント作成
    public function create()
    {
        $user = Auth::user();
        return view('create', ['user_id' => $user->id]);
    }
    public function store(Request $request)
    {
        Event::create($request->all());
        return redirect('/events');
    }
}
