<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Model::unguard();
        $this->call('UsersTableSeeder');
        // $this->call('TutaposSettingTableSeeder');
        $this->call('CurrencyTableSeeder');
        $this->call('PermissionTableSeeder');
        $this->call('CustomersTableSeeder');
        /*$this->call('SuppliersTableSeeder');
        $this->call('ExpenseCategoriesTableSeeder');
        $this->call('ExpensesTableSeeder');
        $this->call('ItemsTableSeeder');*/
    }
}
