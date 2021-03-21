<?php

use App\Models\Answer;
use Illuminate\Database\Seeder;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataSet = [];
        for ($i = 1; $i <= 11; $i++) {

            $event_id = 1;
            $nickname = 'test' . $i;
            $grade = mt_rand(1, 4);
            $gender = mt_rand(1, 2);

            $dataSet[$i - 1] = [
                'event_id' => $event_id,
                'nickname' => $nickname,
                'gender' => $gender,
                'grade' => $grade,
            ];

            for ($g = 1; $g <= 20; $g++) {
                $dataSet[$i - 1] += ['q' . $g => mt_rand(1, 4)];
            }
        }

        foreach ($dataSet as $data) {
            Answer::create($data);
        }
    }
}
