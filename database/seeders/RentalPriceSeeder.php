<?php

namespace Database\Seeders;

use App\Models\RentalPrice;
use Illuminate\Database\Seeder;

class RentalPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $forums = [
            [
                'start' => 0,
                'end' => 250,
                'name'=>'$ 0 - $ 250/Month',
            ],
            [
                'start' => 250,
                'end' => 500,
                'name'=>'$ 250 - $ 500/Month',
            ],
            [
                'start' => 500,
                'end' => 1000,
                'name'=>'$ 500 - $ 1.000/Month',
            ],
            [
                'start' => 1000,
                'end' => 1500,
                'name'=>'$ 1.000 - $ 1.500/Month',
            ],
            [
                'start' => 1500,
                'end' => 2000,
                'name'=>'$ 1.500 - $ 2.000/Month',
            ],
            [
                'start' => 2000,
                'end' => 2500,
                'name'=>'$ 2.000 - $ 2.500/Month',
            ],
            [
                'start' => 2500,
                'end' => 3000,
                'name'=>'$ 2.500 - $ 3.000/Month',
            ],
            [
                'start' => 3000,
                'end' => 3500,
                'name'=>'$ 3.000 - $ 3.500/Month',
            ],
            [
                'start' => 3500,
                'end' => 4000,
                'name'=>'$ 3.500 - $ 4.000/Month',
            ],
            [
                'start' => 4000,
                'end' => 4500,
                'name'=>'$ 3.500 - $ 4.000/Month',
            ],
            [
                'start' => 4500,
                'end' => 5000,
                'name'=>'$ 4.000 - $ 5.000/Month',
            ],
            [
                'start' => 5000,
                'end' => 7500,
                'name'=>'$ 5.000 - $ 7.500/Month',
            ],
            [
                'start' => 7500,
                'end' => 10000,
                'name'=>'$ 7.500/Month - $ 10.000/Month',
            ],
            [
                'start' => 10000,
                'end' => 10000000,
                'name'=>'$ 10.000/Month +',
            ],
            [
                'start' => 0,
                'end' => 10000000,
                'name'=>'All Prices/Month',
            ],



        ];

        foreach ($forums as $forum){
            $data = new RentalPrice($forum);
            $data->save();
        }
    }
}
