<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'email' => 'admin@fortpms.com',
            'user_type' => 'SUPER_ADMIN',
            'parent_id' => 1,
            'employee_id' => 1,
            'branch_id' => 1,
            'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('plans')->insert([
            'id' => 1,
            'name' => 'Free',
            'price' => 0.00,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('subscriptions')->insert([
            'id' => 1,
            'user_id' => 1,
            'plan_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('settings')->insert([
            'id' => 1,
            'user_id' => 1,
            'station_name' => 'Fueling Station',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('taxes')->insert([
            'id' => 1,
            'name' => 'VAT',
            'rate' => 7.5,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('branches')->insert([
            'id' => 1,
            'name' => 'Main Branch 7 Nine',
            'address' => 'Ibadan, Nigeria',
            'phone' => '08099499444',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('branches')->insert([
            'id' => 2,
            'name' => 'Total',
            'address' => 'Ibadan, Nigeria',
            'phone' => '08099499444',
            'user_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('products')->insert([
            'id' => 1,
            'user_id' => 1,
            'name' => 'Petrol (PMS)',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('branch_product')->insert([
            'product_id' => 1,
            'branch_id' => 1,
            'cost' => 150,
            'price' => 180
        ]);
        DB::table('tanks')->insert([
            'id' => 1,
            'user_id' => 1,
            'name' => 'Fuel Tank 1',
            'product_id' => 1,
            'balance' => 0.00,
            'branch_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('pumps')->insert([
            'id' => 1,
            'user_id' => 1,
            'name' => 'Pump One',
            'tank_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('expense_categories')->insert([
            'id' => 1,
            'user_id' => 1,
            'name' => 'Default',
            'parent_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('expense_categories')->insert([
            'id' => 2,
            'user_id' => 1,
            'name' => 'Maintenance',
            'parent_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('expense_categories')->insert([
            'id' => 3,
            'user_id' => 1,
            'name' => 'Plumbing',
            'parent_id' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('expense_categories')->insert([
            'id' => 4,
            'user_id' => 1,
            'name' => 'Product Purchases',
            'parent_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        DB::table('suppliers')->insert([
            'id' => 1,
            'user_id' => 1,
            'name' => 'ABC Supplier',
            'contact_person_name' => 'ABC Supplier',
            'contact_person_phone' => '08094488443',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('customers')->insert([
            'id' => 1,
            'user_id' => 1,
            'name' => 'Walk-in Customer',
            'phone' => '0804994944',
            'type' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('employees')->insert([
            'id' => 1,
            'user_id' => 1,
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'role_id' => 1,
            'branch_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('employees')->insert([
            'id' => 2,
            'user_id' => 1,
            'first_name' => 'Chimere',
            'last_name' => 'Eze',
            'gender' => 'Male',
            'phone' => '08099844755',
            'address' => 'Port Harcourt',
            'role_id' => 3,
            'branch_id' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
