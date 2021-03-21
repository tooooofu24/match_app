<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



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
    public function showQuestions($hashed_id, Request $request, $current_page)
    {
        if ($current_page == 1) {
            session()->put([
                'nickname' => $request->input('nickname'),
                'gender' => $request->input('gender'),
                'grade' => $request->input('grade'),
            ]);
        } else {
            $pre_page = $current_page - 1;
            session()->put(['q' . $pre_page => $request->input('q' . $pre_page)]);
        }
        //設問の選択肢を配列に入れる
        $options = [];
        if ($current_page == 1) {
            $options = ['映画/読書', 'スポーツ', 'SNS', 'ゲーム', '音楽', 'ショッピング/食べること'];
            $question = '趣味はなんですか？';
        } elseif ($current_page == 2) {
            $options = ['J-POP', 'ロック', 'K-POP', '洋楽', 'ヒップホップ', 'ジャズ', 'クラシック'];
            $question = 'よく聴く音楽は？';
        } elseif ($current_page == 3) {
            $question = 'この中で一番好きなスポーツは？';
            $options = ['野球', 'サッカー', 'バレーボール', 'テニス', 'バスケットボール', '卓球', 'バドミントン'];
        } elseif ($current_page == 4) {
            $question = '鬼滅の刃の好きな柱は？';
            $options = ['富岡義勇', '胡蝶しのぶ', '煉獄杏寿郎', '宇髄天元', '時透無一郎', '甘露寺蜜璃', '悲鳴嶼行冥', '伊黒小芭内', '不死川実弥', '鬼滅を見ていない'];
        } elseif ($current_page == 5) {
            $question = '犬派？猫派？';
            $options = ['犬！', '猫！'];
        } elseif ($current_page == 6) {
            $question = 'ディズニー？';
            $options = ['ランド！', 'シー！'];
        } elseif ($current_page == 7) {
            $question = '夏と冬だったらどっち派？';
            $options = ['夏', '冬'];
        } elseif ($current_page == 8) {
            $question = '好きな服装は？';
            //服装
        } elseif ($current_page == 9) {
            if (session('gender') == 1) {
                $question = 'あなたは３人の中だと誰の性格に近い？';
            } else {
                $question = '３人の中だったら誰がタイプ？';
            }
            $options = ['織田信長', '豊臣秀吉', '徳川家康'];
        } elseif ($current_page == 10) {
            if (session('gender') == 1) {
                $question = 'あなたの性格を一言で表すなら？';
                $options = ['明るい', 'クリエイティブ', '協調性がある', '誠実'];
            } else {
                $question = '彼氏にするなら何を一番重視する？';
                $options = ['明るさ', 'クリエイティブさ', '協調性', '誠実さ'];
            }
        } elseif ($current_page == 11) {
            if (session('gender') == 1) {
                $question = '女の子の理想の身長は？';
            } else {
                $question = 'あなたの身長を教えてください';
            }
            //身長
        } elseif ($current_page == 12) {
            if (session('gender') == 1) {
                $question = '女の子の好きな髪型？';
            } else {
                $question = 'あなたの髪の長さは？';
            }
            $options = ['ショート', 'ミディアム', 'ロング'];
        } elseif ($current_page == 13) {
            if (session('gender') == 1) {
                $question = '文化部女子と運動部女子、どっちが好き？';
            } else {
                $question = 'あなたの高校時代の部活は？';
            }
            $options = ['文化部', '運動部'];
        } elseif ($current_page == 14) {
            $question = '最も興味のある占いは？';
            if (session('gender') == 1) {
                $options = ['星占い', '風水', 'タロット', '前世占い'];
            } else {
                $options = ['星占い', 'タロット', '風水', '前世占い'];
            }
            //星、依存少ない。風水、相手が依存する。タロット、完全に依存。前世占い、服従。
        } elseif ($current_page == 15) {
            $question = 'デートの待ち合わせで、あなたは早めに待ち合わせ場所に着きました。約束の時間まであともう少しです。';
            if (session('gender') == 1) {
                $options = ['今日のデートプランについて考える', '待たせると悪いから、早く着いてよかった', 'できれば時間通りに来て欲しい'];
            } else {
                $options = ['今日のデートプランについて考える', 'できれば時間通りに来て欲しい', '待たせると悪いから、早く着いてよかった'];
            }
            //束縛嫌い。束縛されたい。束縛したがる。束縛する。
        } elseif ($current_page == 16) {
            $question = '帰り道、自宅の最寄駅のついたときに急に雨が降ってきました。さて、どうする？';
            $options = ['自宅まで走って帰る', '駅の売店で傘を買う', '迎えを頼む', '雨宿りをする'];
        } elseif ($current_page == 17) {
            if (session('gender') == 1) {
                $question = 'あなたの性格や状態を四字熟語で表すとしたら、次のうちどれ？';
                $options = ['天真爛漫', '研究熱心', '知覚過敏', '疲労困憊'];
            } else {
                $question = 'あなたの性格に一番近いものは？';
                $options = ['ツッコミ上手', '社交的', '寂しがり屋', '気配り上手'];
            }
        } elseif ($current_page == 18) {
            $question = 'あなたが散歩をしていると、可愛らしい子猫を見つけました。それはどんな子猫ですか？';
            $options = ['こちらをずっと見つめてくる子猫', '寄ってきて懐いてくる子猫', '小石で遊んでいる子猫', '怪我をしている子猫'];
            //年上好き。同い年が好き。年齢を気にしない。年下好き。
        } elseif ($current_page == 19) {
            if (session('gender') == 1) {
                $question = '白い薔薇と赤い薔薇を使って相手に花束を作りましょう。バラの本数は合計20本にしてください。赤い薔薇は何本にしますか？';
            } else {
                $question = '白い薔薇と赤い薔薇を使って相手に花束を作りましょう。バラの本数は合計20本にしてください。白い薔薇は何本にしますか？';
            }
            //バラの本数
        } elseif ($current_page == 20) {
            $question = '最後の質問です。この質問でいよいよマッチする相手が決まります。マッチした相手にマグカップを渡すとしたら、次の四色のうち何色を渡しますか？';
            $options = ['緑', 'オレンジ', '青', 'ピンク'];
        }


        return view('questions.questions', ['event' => session('event'), 'current_page' => $current_page, 'options' => $options, 'question' => $question]);
    }

    //回答の確認
    public function confirm($hashed_id, Request $request)
    {
        session()->put(['q20' => $request->input('q20')]);
        return view('questions.confirm', ['event' => session('event')]);
    }
    //回答の保存
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

        for ($i = 1; $i <= 20; $i++) {
            $question = "q$i";
            $answer->$question = session($question);
        }

        $answer->save();

        session()->forget([
            'event',
            'event_id',
            'nickname',
            'gender',
            'grade',
            'q1',
            'q2',
            'q3',
            'q4',
            'q5',
            'q6',
            'q7',
            'q8',
            'q9',
            'q10',
            'q11',
            'q12',
            'q13',
            'q14',
            'q15',
            'q16',
            'q17',
            'q18',
            'q19',
            'q20',
        ]);

        return redirect()->route('home');
    }


    public function showAllResults($hashed_id)
    {
        //結果を取得
        $event = DB::table('events')->where('hashed_id', $hashed_id)->first();
        $event_id = $event->id;
        $results = DB::table('results')->where('event_id', $event_id)->get();
        $answers = DB::table('answers')->where('event_id', $event_id)->get();

        return view('results.all_results', ['results' => $results, 'answers' => $answers, 'event' => $event]);
    }
    public function showPersonalResults($hashed_id, $id)
    {
        $event = DB::table('events')->where('hashed_id', $hashed_id)->first();
        $event_id = $event->id;
        $answers = DB::table('answers')->where('event_id', $event_id)->get();
        $result = DB::table('results')->where('id', $id)->first();
        $male = DB::table('answers')->where('id', $result->male)->first();
        $female = DB::table('answers')->where('id', $result->female)->first();
        if ($result->remainder) {
            $remainder = DB::table('answers')->where('id', $result->remainder)->first();
        } else {
            $remainder = null;
        }

        $options = [
            1 => ['映画/読書', 'スポーツ', 'SNS', 'ゲーム', '音楽', 'ショッピング/食べること'],
            2 => ['J-POP', 'ロック', 'K-POP', '洋楽', 'ヒップホップ', 'ジャズ', 'クラシック'],
            3 => ['野球', 'サッカー', 'バレーボール', 'テニス', 'バスケットボール', '卓球', 'バドミントン'],
            4 => ['富岡義勇', '胡蝶しのぶ', '煉獄杏寿郎', '宇髄天元', '時透無一郎', '甘露寺蜜璃', '悲鳴嶼行冥', '伊黒小芭内', '不死川実弥', '鬼滅を見ていない'],
            5 => ['犬！', '猫！'],
            6 => ['ランド！', 'シー！'],
            7 => ['夏', '冬'],
            9 => ['織田信長', '豊臣秀吉', '徳川家康'],
            10 => [
                'male' => ['明るい', 'クリエイティブ', '協調性がある', '誠実'],
                'female' => ['明るさ', 'クリエイティブさ', '協調性', '誠実さ'],
            ],
            12 => ['ショート', 'ミディアム', 'ロング'],
            13 => ['文化部', '運動部'],
            14 => [
                'male' => ['星占い', '風水', 'タロット', '前世占い'],
                'female' =>  ['星占い', 'タロット', '風水', '前世占い'],
            ],
            15 => [
                'male' => ['今日のデートプランについて考える', '待たせると悪いから、早く着いてよかった', 'できれば時間通りに来て欲しい'],
                'female' => ['今日のデートプランについて考える', 'できれば時間通りに来て欲しい', '待たせると悪いから、早く着いてよかった'],
            ],
            16 => ['自宅まで走って帰る', '駅の売店で傘を買う', '迎えを頼む', '雨宿りをする'],
            17 => [
                'male' => ['天真爛漫', '研究熱心', '知覚過敏', '疲労困憊'],
                'female' => ['ツッコミ上手', '社交的', '寂しがり屋', '気配り上手']
            ],
            18 => ['こちらをずっと見つめてくる子猫', '寄ってきて懐いてくる子猫', '小石で遊んでいる子猫', '怪我をしている子猫'],
            20 => ['緑', 'オレンジ', '青', 'ピンク'],
        ];
        $questions = [
            1 => '趣味はなんですか？',
            2 => 'よく聴く音楽は？',
            3 => 'この中で一番好きなスポーツは？',
            4 => '鬼滅の刃の好きな柱は？',
            5 => '犬派？猫派？',
            6 => 'ディズニー？',
            7 => '夏と冬だったらどっち派？',
            8 => '好きな服装は？',
            9 => [
                'male' => 'あなたは３人の中だと誰の性格に近い？',
                'female' => '３人の中だったら誰がタイプ？',
            ],
            10 => [
                'male' => 'あなたの性格を一言で表すなら？',
                'female' => '彼氏にするなら何を一番重視する？'
            ],
            11 => [
                'male' => '女の子の理想の身長は？',
                'female' => 'あなたの身長を教えてください'
            ],
            12 => [
                'male' => '女の子の好きな髪型？',
                'female' => 'あなたの髪の長さは？'
            ],
            13 => [
                'male' => '文化部女子と運動部女子、どっちが好き？',
                'female' => 'あなたの高校時代の部活は？'
            ],
            14 => '最も興味のある占いは？',
            15 => 'デートの待ち合わせで、あなたは早めに待ち合わせ場所に着きました。約束の時間まであともう少しです。',
            16 => '帰り道、自宅の最寄駅のついたときに急に雨が降ってきました。さて、どうする？',
            17 => [
                'male' => 'あなたの性格や状態を四字熟語で表すとしたら、次のうちどれ？',
                'female' => 'あなたの性格に一番近いものは？'
            ],
            18 => 'あなたが散歩をしていると、可愛らしい子猫を見つけました。それはどんな子猫ですか？',
            19 => [
                'male' => '白い薔薇と赤い薔薇を使って相手に花束を作りましょう。バラの本数は合計20本にしてください。赤い薔薇は何本にしますか？',
                'female' => '白い薔薇と赤い薔薇を使って相手に花束を作りましょう。バラの本数は合計20本にしてください。白い薔薇は何本にしますか？'
            ],
            20 => '最後の質問です。この質問でいよいよマッチする相手が決まります。マッチした相手にマグカップを渡すとしたら、次の四色のうち何色を渡しますか？',
        ];

        return view('results.personal_results', ['result' => $result, 'male' => $male, 'female' => $female, 'remainder' => $remainder, 'options' => $options, 'questions' => $questions, 'answers' => $answers]);
    }
}
