<?php

use Illuminate\Database\Seeder;

class ExpenseCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('expense_categories')->insert([
            [
                'name' => 'Living',
                'slug' => 'living',
                'description' => 'migration is here'
            ],

            [
                'name' => 'Regular Payment',
                'slug' => 'regular_payment',
                'description' => 'migration is here'
            ],

            [
                'name' => 'Food Expenses',
                'slug' => 'food_expenses',
                'description' => 'migration is here'
            ],

            [
                'name' => 'Personal Expenses',
                'slug' => 'personal_expenses',
                'description' => 'migration is here'
            ],

            [
                'name' => 'Transportation',
                'slug' => 'transportation',
                'description' => 'migration is here'
            ],

            [
                'name' => 'Miscellaneous',
                'slug' => 'miscellaneous',
                'description' => 'migration is here'
            ],

            [
                'name' => 'Bank Charge',
                'slug' => 'bank_charge',
                'description' => 'migration is here'
            ],

            [
                'name' => 'Insurance',
                'slug' => 'insurance',
                'description' => 'migration is here'
            ],

            [
                'name' => 'Maintainence',
                'slug' => 'maintainence',
                'description' => 'migration is here'
            ],

            [
                'name' => 'Tax',
                'slug' => 'tax',
                'description' => 'migration is here'
            ]

        ]);
    }
}
