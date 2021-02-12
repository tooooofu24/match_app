<?php

use App\User;
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
                'password' => 'password',
            ],
            [
                'name' => '髙野佳菜子',
                'email' => 'kanako@gmail.com',
                'password' => 'password',
            ],
            [
                'name' => '石田京楓',
                'email' => 'kyoka@gmail.com',
                'password' => 'password',
            ],
        ];

        foreach ($dataSet as $data) {
            User::create($data);
        }
    }
}
