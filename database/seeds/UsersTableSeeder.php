<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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
                'name' => '千葉陶也',
                'email' => 'toya24xxx@i.softbank.jp',
            ],
            [
                'name' => '髙野佳菜子',
                'email' => 'kanako@gmail.com',
            ],
            [
                'name' => '石田京楓',
                'email' => 'kyoka@gmail.com',
            ],
        ];

        foreach ($dataSet as $data) {
            User::create($data);
        }
    }
}
