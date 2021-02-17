<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Session\SessionManager;
use Illuminate\Http\RedirectResponse;


class AnswerController extends Controller
{

    //質問のトップページの表示
    public function showTop($hashed_id)
    {
        $event = DB::table('events')->where('hashed_id', $hashed_id)->first();
        session()->put(['event' => $event]);
        return view('questions.top', ['event' => session('event')]);
    }

    //質問ページの表示
    public function showQuestions($hashed_id, Request $request, $current_q)
    {
        if ($current_q == 1) {
            session()->put([
                'nickname' => $request->input('nickname'),
                'gender' => $request->input('gender'),
                'grade' => $request->input('grade'),
            ]);
            return view('questions.female.q1', ['event' => session('event')]);
        } else {
            $pre_q = $current_q - 1;
            session()->put(['q' . $pre_q => $request->input('q' . $pre_q)]);
            return view('questions.female.q' . $current_q, ['event' => session('event')]);
        }
    }

    //回答の保存
    public function confirm($hashed_id, Request $request)
    {
        session()->put(['q9' => $request->input('q9')]);
        return view('questions.confirm', ['event' => session('event')]);
    }

    public function store()
    {
        $answer = new Answer;

        $answer->fill(
            [
                'nickname' => session('nickname'),
                'gender' => session('gender'),
                'grade' => session('grade'),
                'event_id' => get_object_vars(session('event'))['id'],
            ]
        );

        for ($i = 1; $i <= 9; $i++) {
            $v = "q$i";
            $answer->$v = session($v);
        }

        $answer->save();

        return redirect()->route('home');
    }
}
