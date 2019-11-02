<?php

use Illuminate\Database\Seeder;

class ExpensesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('expenses')->insert([
            ['expense_category_id'=> '1','qty' => '1','user_id' => '1','unit_price'=>'50000','total' => '50000','payment' => '49500', 'payment_type' => 'cash','dues' => '500', 'description' => 'migration is here'],
            ['expense_category_id'=> '1','qty' => '1','user_id' => '1','unit_price'=>'12123','total' => '12123','payment' => '11623', 'payment_type' => 'cash','dues' => '500', 'description' => 'migration is here'],
            ['expense_category_id'=> '1','qty' => '3','user_id' => '1','unit_price'=>'3000','total' => '9000','payment' => '8500', 'payment_type' => 'cash','dues' => '500', 'description' => 'migration is here'],
            ['expense_category_id'=> '1','qty' => '2','user_id' => '1','unit_price'=>'5000','total' => '10000','payment' => '9500', 'payment_type' => 'cash','dues' => '500', 'description' => 'migration is here'],
            ['expense_category_id'=> '1','qty' => '10','user_id' => '1','unit_price'=>'1800','total' => '18000','payment' => '17500', 'payment_type' => 'cash','dues' => '500', 'description' => 'migration is here'],
            ['expense_category_id'=> '1','qty' => '2','user_id' => '1','unit_price'=>'15000','total' => '30000','payment' => '29500', 'payment_type' => 'cash','dues' => '500', 'description' => 'migration is here'],
            ['expense_category_id'=> '1','qty' => '3','user_id' => '1','unit_price'=>'1500','total' => '4500','payment' => '4000', 'payment_type' => 'cash','dues' => '500', 'description' => 'migration is here'],

            ['expense_category_id'=>  '2','qty' => '1','user_id' => '1','unit_price'=>'50000','total' => '50000','payment' => '49500', 'payment_type' => 'cash','dues' => '500', 'description' => 'migration is here'],
            ['expense_category_id'=>  '2','qty' => '1','user_id' => '1','unit_price'=>'12123','total' => '12123','payment' => '11623', 'payment_type' => 'cash','dues' => '500', 'description' => 'migration is here'],
            ['expense_category_id'=>  '2','qty' => '3','user_id' => '1','unit_price'=>'3000','total' => '9000','payment' => '8500', 'payment_type' => 'cash','dues' => '500', 'description' => 'migration is here'],
            ['expense_category_id'=>  '2','qty' => '2','user_id' => '1','unit_price'=>'5000','total' => '10000','payment' => '9500', 'payment_type' => 'cash','dues' => '500', 'description' => 'migration is here'],
            ['expense_category_id'=>  '2','qty' => '10','user_id' => '1','unit_price'=>'1800','total' => '18000','payment' => '17500', 'payment_type' => 'cash','dues' => '500', 'description' => 'migration is here'],
            ['expense_category_id'=>  '2','qty' => '2','user_id' => '1','unit_price'=>'15000','total' => '30000','payment' => '29500', 'payment_type' => 'cash','dues' => '500', 'description' => 'migration is here'],
            ['expense_category_id'=>  '2','qty' => '3','user_id' => '1','unit_price'=>'1500','total' => '4500','payment' => '4000', 'payment_type' => 'cash','dues' => '500', 'description' => 'migration is here']


        ]);
    }
}
