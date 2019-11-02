<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\User;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $all_permissions = [
            ['label'=>'List Items', 'name'=>'items.index'],
            ['label'=>'Create Items', 'name'=>'items.create'],
            ['label'=>'Store Items', 'name'=>'items.store'],
            ['label'=>'View Items', 'name'=>'items.show'],
            ['label'=>'Delete Items', 'name'=>'items.destroy'],
            ['label'=>'Update Items', 'name'=>'items.update'],
            ['label'=>'Edit Items', 'name'=>'items.edit'],

            ['label'=>'List Inventory', 'name'=>'inventory.index'],
            ['label'=>'Create Inventory', 'name'=>'inventory.create'],
            ['label'=>'Store Inventory', 'name'=>'inventory.store'],
            ['label'=>'View Inventory', 'name'=>'inventory.show'],
            ['label'=>'Delete Inventory', 'name'=>'inventory.destroy'],
            ['label'=>'Update Inventory', 'name'=>'inventory.update'],
            ['label'=>'Edit Inventory', 'name'=>'inventory.edit'],

            ['label'=>'List Customers', 'name'=>'customers.index'],
            ['label'=>'Create Customers', 'name'=>'customers.create'],
            ['label'=>'Store Customers', 'name'=>'customers.store'],
            ['label'=>'View Customers', 'name'=>'customers.show'],
            ['label'=>'Delete Customers', 'name'=>'customers.destroy'],
            ['label'=>'Update Customers', 'name'=>'customers.update'],
            ['label'=>'Edit Customers', 'name'=>'customers.edit'],

            ['label'=>'List Suppliers', 'name'=>'suppliers.index'],
            ['label'=>'Create Suppliers', 'name'=>'suppliers.create'],
            ['label'=>'Store Suppliers', 'name'=>'suppliers.store'],
            ['label'=>'View Suppliers', 'name'=>'suppliers.show'],
            ['label'=>'Delete Suppliers', 'name'=>'suppliers.destroy'],
            ['label'=>'Update Suppliers', 'name'=>'suppliers.update'],
            ['label'=>'Edit Suppliers', 'name'=>'suppliers.edit'],

            ['label'=>'List Receivings', 'name'=>'receivings.index'],
            ['label'=>'Create Receivings', 'name'=>'receivings.create'],
            ['label'=>'Store Receivings', 'name'=>'receivings.store'],
            ['label'=>'View Receivings', 'name'=>'receivings.show'],
            ['label'=>'Delete Receivings', 'name'=>'receivings.destroy'],
            ['label'=>'Update Receivings', 'name'=>'receivings.update'],
            ['label'=>'Edit Receivings', 'name'=>'receivings.edit'],

            ['label'=>'List Transactions', 'name'=>'transactions.index'],
            ['label'=>'Create Transactions', 'name'=>'transactions.create'],
            ['label'=>'Store Transactions', 'name'=>'transactions.store'],
            ['label'=>'View Transactions', 'name'=>'transactions.show'],
            ['label'=>'Delete Transactions', 'name'=>'transactions.destroy'],
            ['label'=>'Update Transactions', 'name'=>'transactions.update'],
            ['label'=>'Edit Transactions', 'name'=>'transactions.edit'],

            ['label'=>'List Supplierpayments', 'name'=>'supplierpayments.index'],
            ['label'=>'Create Supplierpayments', 'name'=>'supplierpayments.create'],
            ['label'=>'Store Supplierpayments', 'name'=>'supplierpayments.store'],
            ['label'=>'View Supplierpayments', 'name'=>'supplierpayments.show'],
            ['label'=>'Delete Supplierpayments', 'name'=>'supplierpayments.destroy'],
            ['label'=>'Update Supplierpayments', 'name'=>'supplierpayments.update'],
            ['label'=>'Edit Supplierpayments', 'name'=>'supplierpayments.edit'],

            ['label'=>'List Sales', 'name'=>'sales.index'],
            ['label'=>'Create Sales', 'name'=>'sales.create'],
            ['label'=>'Store Sales', 'name'=>'sales.store'],
            ['label'=>'View Sales', 'name'=>'sales.show'],
            ['label'=>'Delete Sales', 'name'=>'sales.destroy'],
            ['label'=>'Update Sales', 'name'=>'sales.update'],
            ['label'=>'Edit Sales', 'name'=>'sale.edit'],

            ['label'=>'List Salepayments', 'name'=>'salepayments.index'],
            ['label'=>'Create Salepayments', 'name'=>'salepayments.create'],
            ['label'=>'Store Salepayments', 'name'=>'salepayments.store'],
            ['label'=>'View Salepayments', 'name'=>'salepayments.show'],
            ['label'=>'Delete Salepayments', 'name'=>'salepayments.destroy'],
            ['label'=>'Update Salepayments', 'name'=>'salepayments.update'],
            ['label'=>'Edit Salepayments', 'name'=>'salepayments.edit'],

            ['label'=>'List Dailyreport', 'name'=>'dailyreport.index'],
            ['label'=>'Create Dailyreport', 'name'=>'dailyreport.create'],
            ['label'=>'Store Dailyreport', 'name'=>'dailyreport.store'],
            ['label'=>'View Dailyreport', 'name'=>'dailyreport.show'],
            ['label'=>'Delete Dailyreport', 'name'=>'dailyreport.destroy'],
            ['label'=>'Update Dailyreport', 'name'=>'dailyreport.update'],
            ['label'=>'Edit Dailyreport', 'name'=>'dailyreport.edit'],

            ['label'=>'List Receivingpayments', 'name'=>'receivingpayments.index'],
            ['label'=>'Create Receivingpayments', 'name'=>'receivingpayments.create'],
            ['label'=>'Store Receivingpayments', 'name'=>'receivingpayments.store'],
            ['label'=>'View Receivingpayments', 'name'=>'receivingpayments.show'],
            ['label'=>'Delete Receivingpayments', 'name'=>'receivingpayments.destroy'],
            ['label'=>'Update Receivingpayments', 'name'=>'receivingpayments.update'],
            ['label'=>'Edit Receivingpayments', 'name'=>'receivingpayments.edit'],

            ['label'=>'List Expense', 'name'=>'expense.index'],
            ['label'=>'Create Expense', 'name'=>'expense.create'],
            ['label'=>'Store Expense', 'name'=>'expense.store'],
            ['label'=>'View Expense', 'name'=>'expense.show'],
            ['label'=>'Delete Expense', 'name'=>'expense.destroy'],
            ['label'=>'Update Expense', 'name'=>'expense.update'],
            ['label'=>'Edit Expense', 'name'=>'expense.edit'],

            ['label'=>'List Expensecategory', 'name'=>'expensecategory.index'],
            ['label'=>'Create Expensecategory', 'name'=>'expensecategory.create'],
            ['label'=>'Store Expensecategory', 'name'=>'expensecategory.store'],
            ['label'=>'View Expensecategory', 'name'=>'expensecategory.show'],
            ['label'=>'Delete Expensecategory', 'name'=>'expensecategory.destroy'],
            ['label'=>'Update Expensecategory', 'name'=>'expensecategory.update'],
            ['label'=>'Edit Expensecategory', 'name'=>'expensecategory.edit'],

            ['label'=>'List Customerpayments', 'name'=>'customerpayments.index'],
            ['label'=>'Create Customerpayments', 'name'=>'customerpayments.create'],
            ['label'=>'Store Customerpayments', 'name'=>'customerpayments.store'],
            ['label'=>'View Customerpayments', 'name'=>'customerpayments.show'],
            ['label'=>'Delete Customerpayments', 'name'=>'customerpayments.destroy'],
            ['label'=>'Update Customerpayments', 'name'=>'customerpayments.update'],
            ['label'=>'Edit Customerpayments', 'name'=>'customerpayments.edit'],

            ['label'=>'List Accounts', 'name'=>'accounts.index'],
            ['label'=>'Create Accounts', 'name'=>'accounts.create'],
            ['label'=>'Store Accounts', 'name'=>'accounts.store'],
            ['label'=>'View Accounts', 'name'=>'accounts.show'],
            ['label'=>'Delete Accounts', 'name'=>'accounts.destroy'],
            ['label'=>'Update Accounts', 'name'=>'accounts.update'],
            ['label'=>'Edit Accounts', 'name'=>'accounts.edit'],

            ['label'=>'List Employees', 'name'=>'employees.index'],
            ['label'=>'Create Employees', 'name'=>'employees.create'],
            ['label'=>'Store Employees', 'name'=>'employees.store'],
            ['label'=>'View Employees', 'name'=>'employees.show'],
            ['label'=>'Delete Employees', 'name'=>'employees.destroy'],
            ['label'=>'Update Employees', 'name'=>'employees.update'],
            ['label'=>'Edit Employees', 'name'=>'employees.edit'],

            ['label'=>'List Settings', 'name'=>'flexiblepossetting.index'],
            ['label'=>'Create Settings', 'name'=>'flexiblepossetting.create'],
            ['label'=>'Store Settings', 'name'=>'flexiblepossetting.store'],
            ['label'=>'View Settings', 'name'=>'flexiblepossetting.show'],
            ['label'=>'Delete Settings', 'name'=>'flexiblepossetting.destroy'],
            ['label'=>'Update Settings', 'name'=>'flexiblepossetting.update'],
            ['label'=>'Edit Settings', 'name'=>'flexiblepossetting.edit'],


            ['label'=>'List Permissions', 'name'=>'permissions.list'],
            ['label'=>'Assaign Roles', 'name'=>'assaign.roles'],
            ['label'=>'Create Roles', 'name'=>'employeerole.create'],
            ['label'=>'Create Permission Role', 'name'=>'permissionrole.create'],
            ['label'=>'Create Permissions', 'name'=>'permissions.create'],

            ['label'=>'Getsales Reports', 'name'=>'reports.getsales'],
            ['label'=>'CreateDaily Reports', 'name'=>'reports.createdaily'],
            ['label'=>'CreatePast Reports', 'name'=>'reports.createpast'],
            ['label'=>'GetDaily Reports', 'name'=>'reports.getdaily'],
            ['label'=>'CreateCustom Items', 'name'=>'items.customcreate'],
            ['label'=>'PrintSales Reports', 'name'=>'reports.printsales'],
            ['label'=>'GetAllSale Reports', 'name'=>'reports.getsalereport'],

            ['label'=>'Sale-receive-chart Dashboard', 'name'=>'Sale-receive-chart Dashboard'],
            ['label'=>'Latest-income-expense Dashboard', 'name'=>'Latest-income-expense Dashboard'],

           // ['label'=>'Create Roles', 'name'=>'employeerole.create']
        ];
        $existing_permissions = Permission::pluck('name');
        foreach ($all_permissions as $value) {
            if (!in_array($value['name'], $existing_permissions->toArray())) {
                Permission::create([
                    'label'=>$value['label'],
                    'name'=>$value['name']
                ]);
            }
        }
        //$role = Role::where('name', 'admin')->first();
        if (! $role = Role::where('name', 'admin')->first()) {
            echo "creating Admin Role";
            $role = Role::create(['name' => 'admin']);
        }
        $user = User::where('email', 'admin@flexibleit.net')->first();
        if (! $hasrole = $user->hasRole('admin')) {
            $user->assignRole('admin');
        }
//        $role->givePermissionTo('assaign.roles');
//        $role->givePermissionTo('permissions.list');
//        $role->givePermissionTo('permissionrole.create');
//        $role->givePermissionTo('permissions.create');
//        $role->givePermissionTo('employees.index');
        foreach ($all_permissions as $value) {
            if (! $permissionexist = $role->hasPermissionTo($value['name'])) {
                $role->givePermissionTo($value['name']);
            }
        }
    }
}
