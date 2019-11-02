<?php

use App\Supplier;
use Faker\Factory;
use Illuminate\Database\Seeder;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for($i = 0; $i < 265; $i++) {
            Supplier::create([
                'company_name' => $faker->company,
                'name' => $faker->name,
                'email' => $faker->freeemail,
                'phone_number' => $faker->e164PhoneNumber,
                'address' => $faker->address,
                'city' => $faker->city,
                'state' => $faker->state,
                'zip' => $faker->postcode,
                //'comment' => 'no comment',
                'account' =>$faker->creditCardType,
                'prev_balance' => '10000',
                'payment'=>$faker->randomNumber($nbDigits = 5, $strict = true),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }
    }
}
