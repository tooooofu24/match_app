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
            ],
            [
                'user_id' => 1,
                'name' => '春のあおりょ2020',
            ],
            [
                'user_id' => 2,
                'name' => '春なかりょ',
            ],
        ];

        foreach ($dataSet as $data) {
            Event::create($data);
        }
    }
}
