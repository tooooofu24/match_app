<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Jobs\OptimiseMatchingResult;
use App\Models\Result;

class EventController extends Controller
{
    //イベント一覧-------------------------------------------------------------------------------------------------------
    public function showEvents()
    {
        $user = Auth::user();
        $events = DB::table('events')->where('user_id', $user->id)->get();

        return view('events', ['events' => $events]);
    }
    //イベント詳細-------------------------------------------------------------------------------------------------------
    public function confirmEvent($id)
    {
        $event = DB::table('events')->where('id', $id)->first();
        $answers = DB::table('answers')->where('event_id', $id)->get();

        return view('confirm', ['event' => $event, 'answers' => $answers]);
    }

    //イベント作成-------------------------------------------------------------------------------------------------------
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

    //結果の出力-------------------------------------------------------------------------------------------------------
    public function getResult($id)
    {
        $event = DB::table('events')->where('id', $id)->first();
        $event_id = $event->id;
        $answers = DB::table('answers')->where('event_id', $event_id)->get();

        //男女の解答を分ける
        $maleAnswers = collect();
        $femaleAnswers = collect();

        foreach ($answers as $answer) {
            if ($answer->gender == 1) {
                $maleAnswers->push($answer);
            } else {
                $femaleAnswers->push($answer);
            }
        }

        //ランダムマッチ
        $maleAnswersCount = count($maleAnswers);
        $femaleAnswersCount = count($femaleAnswers);
        $sameGenders = collect();
        $remainder = null;

        //男性の方が多い場合
        if ($maleAnswersCount > $femaleAnswersCount) {
            if (($maleAnswersCount + $femaleAnswersCount) % 2 === 1) {
                $remainder_key = $maleAnswers->keys()->random();
                $remainder = $maleAnswers->get($remainder_key);
                $maleAnswers = $maleAnswers->forget($remainder_key);
                $maleAnswersCount--;
            }
            $difference = $maleAnswersCount - $femaleAnswersCount;
            $sameGenders_keys = $maleAnswers->keys()->random($difference);
            foreach ($sameGenders_keys as $key) {
                $sameGenders->push($maleAnswers->get($key));
                $maleAnswers = $maleAnswers->forget($key);
            }
            //女性の方が多い場合
        } elseif ($maleAnswersCount < $femaleAnswersCount) {
            if (($maleAnswersCount + $femaleAnswersCount) % 2 === 1) {
                $remainder_key = $femaleAnswers->keys()->random();
                $remainder = $femaleAnswers->get($remainder_key);
                $femaleAnswers = $femaleAnswers->forget($remainder_key);
                $femaleAnswersCount--;
            }
            $difference = $femaleAnswersCount - $maleAnswersCount;
            $sameGenders_keys = $femaleAnswers->keys()->random($difference);
            foreach ($sameGenders_keys as $key) {
                $sameGenders->push($femaleAnswers->get($key));
                $femaleAnswers = $femaleAnswers->forget($key);
            }
        }
        //$results[['male'=>1,'female'=>2]]を作成
        $results = collect();
        $maleAnswers = $maleAnswers->shuffle();
        foreach ($maleAnswers as $maleAnswer) {
            foreach ($femaleAnswers as $key => $femaleAnswer) {
                $newResult = collect(['male' => $maleAnswer->id, 'female' => $femaleAnswer->id]);
                $results->push($newResult);
                $femaleAnswers = $femaleAnswers->forget($key);
                break;
            }
        }
        foreach ($sameGenders as $key => $sameGender) {
            if (count($sameGenders) === 0) {
                break;
            }
            $lastKey = $sameGenders->keys()->last();
            $last = $sameGenders->get($lastKey);
            $newResult = collect(['male' => $sameGender->id, 'female' => $last->id]);
            $results->push($newResult);
            $sameGenders = $sameGenders->forget($key);
            $sameGenders = $sameGenders->forget($lastKey);
        }

        //DBに保存
        foreach ($results as $v) {
            $result = new Result;
            $result->event_id = $event_id;
            $result->male = $v['male'];
            $result->female = $v['female'];
            if ($remainder) {
                $result->remainder = $remainder->id;
                $remainder = null;
            }
            $result->save();
        }
        $event = DB::table('events')->where('id', $id);
        $event->update(['outputed' => 1]);

        $event = DB::table('events')->where('id', $id)->first();

        return view('confirm', ['event' => $event, 'answers' => $answers]);
    }
    //-------------------------------------------------------------------------------------------------------
    public function test()
    {
        print 'テスト用です';
    }
}
