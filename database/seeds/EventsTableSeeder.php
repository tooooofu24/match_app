<?php

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataSet = [
            [
                'user_id' => 1,
                'name' => '学キャン2019',
                'hashed_id' => 1,
            ],
            [
                'user_id' => 1,
                'name' => '春のあおりょ2020',
                'hashed_id' => 2,
            ],
            [
                'user_id' => 2,
                'name' => '春なかりょ',
                'hashed_id' => 3,
            ],

        ];

        foreach ($dataSet as $data) {
            $data['hashed_id'] = hash('md5', $data['hashed_id']);
            Event::create($data);
        }
    }
}
