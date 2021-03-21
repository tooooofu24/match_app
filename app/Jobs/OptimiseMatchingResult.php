<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use App\Models\Result;

class OptimiseMatchingResult implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $id;
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $id = $this->id;
        $event = DB::table('events')->where('id', $id)->first();
        $event_id = $event->id;
        $answers = DB::table('answers')->where('event_id', $event_id)->get();

        $answersArray = (array)$answers;
        $answers = array_values($answersArray)[0];

        $maleAnswers = [];
        $femaleAnswers = [];
        $maleCount = 0;
        $femaleCount = 0;


        //男女の解答を分ける
        foreach ($answers as $answer) {
            $answer = (array)$answer;
            if ($answer['gender'] == 1) {
                $maleAnswers[$maleCount] = $answer;
                $maleCount++;
            } else {
                $femaleAnswers[$femaleCount] = $answer;
                $femaleCount++;
            }
        }

        $results = [
            'male' => [],
            'female' => [],
        ];

        //男のマッチ結果
        foreach ($maleAnswers as $maleAnswer) {
            $results['male'] += [$maleAnswer['id'] => []];
            $femaleAnswer['id'] = 0;

            foreach ($maleAnswers as $maleAnswer) {

                $matchCount = 0;

                for ($i = 1; $i <= 20; $i++) {

                    if ($maleAnswer['q' . $i] == $femaleAnswer['q' . $i]) {
                        $matchCount++;
                    }
                }
                $results['male'][$maleAnswer['id']] += [$femaleAnswer['id'] => $matchCount];
            }
        }


        //女のマッチ結果
        foreach ($femaleAnswers as $femaleAnswer) {
            $results['female'] += [$femaleAnswer['id'] => []];
            $maleAnswer['id'] = 0;

            foreach ($maleAnswers as $maleAnswer) {

                $matchCount = 0;

                for ($i = 1; $i <= 20; $i++) {

                    if ($femaleAnswer['q' . $i] == $maleAnswer['q' . $i]) {
                        $matchCount++;
                    }
                }
                $results['female'][$femaleAnswer['id']] += [$maleAnswer['id'] => $matchCount];
            }
        }



        //女idの配列
        $femaleIds = [];
        foreach ($results['female'] as $k => $v) {
            array_push($femaleIds, $k);
        }
        //男のid配列
        $maleIds = [];
        foreach ($results['male'] as $k => $v) {
            array_push($maleIds, $k);
        }

        //結果を出力
        $maleResults = $results['male'];
        $bestMatchPoint = 0;
        foreach ($this->pc_permute($femaleIds) as $values) {
            $matchPoint = 0;
            foreach ($values as $k => $v) {
                $matchPoint += $maleResults[$maleIds[$k]][$v];
            }
            if ($bestMatchPoint < $matchPoint) {
                $bestMatchPoint = $matchPoint;
                $matchResult = $values;
            }
        }
        DB::table('results')->insert(
            [
                'event_id' => 99,
                'male' => 99,
                'female' => 99,
            ]
        );


        $count = 0;
        foreach ($matchResult as $female) {
            $result = new Result;
            $result->event_id = $event_id;
            $result->male = $maleIds[$count];
            $result->female = $female;
            $result->point = $maleResults[$maleIds[$count]][$female];
            $result->save();
            ++$count;
        }

        $event = DB::table('events')->where('id', $id)->limit(1);
        $event->update(['result' => 2]);
    }
    function pc_permute($items, $perms = array())
    {
        if (empty($items)) {
            yield $perms;
        } else {
            for ($i = count($items) - 1; $i >= 0; --$i) {
                $newitems = $items;
                $newperms = $perms;
                list($foo) = array_splice($newitems, $i, 1);
                array_unshift($newperms, $foo);
                foreach ($this->pc_permute($newitems, $newperms) as $v) {
                    yield $v;
                }
            }
        }
    }
}
