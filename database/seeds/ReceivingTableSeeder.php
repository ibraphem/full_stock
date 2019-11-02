<?php

use App\Receiving;
use Illuminate\Database\Seeder;

class ReceivingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i = 0; $i < 1125; $i++) {
            App\Receiving::create([
                ''=>'',
            ]);
        }
    }
}
