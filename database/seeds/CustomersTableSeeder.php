<?php

use App\Customer;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $faker = Faker\Factory::create();
        // for ($i = 0; $i < 1125; $i++) {
        //     App\Customer::create([
        //         'name' => $faker->name,
        //         'email' => $faker->email,
        //         'phone_number' => $faker->e164PhoneNumber,
        //         'address' => $faker->address,
        //         'city' => $faker->city,
        //         'state' => $faker->state,
        //         'zip' => $faker->postcode,
        //         'company_name' => $faker->company,
        //         'account' =>$faker->creditCardType,
        //         'prev_balance' => '10000',
        //         'payment'=>$faker->randomNumber($nbDigits = 5, $strict = true),
        //         'created_at' => date("Y-m-d H:i:s"),
        //         'updated_at' => date("Y-m-d H:i:s")
        //     ]);
        // }
        if (! $customer = App\Customer::where('name', 'Walking Customer')->first()) {
            App\Customer::create([
                'name' => App\Customer::WALKING_CUSTOMER,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }
    }
}
