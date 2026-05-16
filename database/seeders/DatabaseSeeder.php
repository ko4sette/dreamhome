<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // 1. Create a Branch first (since Staff need a branch_id)
        $branchId = DB::table('branches')->insertGetId([
            'branch_name' => 'Main Office',
            'street' => '123 Dream Ave',
            'area' => 'Downtown',
            'city' => 'Metropolis',
            'postcode' => '12345',
            'telephone' => '555-0100',
            'created_at' => $now,
            'updated_at' => $now,
        ], 'branch_id');

        // 2. Define the 4 Roles we want to create
        $roles = [
            ['position' => 'Manager', 'name' => 'John', 'email' => 'manager@dreamhome.com'],
            ['position' => 'Supervisor', 'name' => 'Alice', 'email' => 'supervisor@dreamhome.com'],
            ['position' => 'Secretary', 'name' => 'Diana', 'email' => 'secretary@dreamhome.com'],
            ['position' => 'Regular staff', 'name' => 'Bob', 'email' => 'staff@dreamhome.com'],
        ];

        // 3. Loop through and create a Staff record, then a User account for each
        foreach ($roles as $roleData) {
            
            // Step A: Create the Staff Member
            $staffId = DB::table('staff')->insertGetId([
                'branch_id' => $branchId,
                'name' => $roleData['name'],
                'surname' => 'Test',
                'position' => $roleData['position'], // This dictates their RBAC Access!
                'salary' => 40000.00,
                'created_at' => $now,
                'updated_at' => $now,
            ], 'staff_id');

            // Step B: Create the User Account and link it to the Staff ID
            DB::table('users')->insert([
                'name' => $roleData['name'] . ' Test',
                'email' => $roleData['email'],
                'password' => Hash::make('12345678'), // Default password
                'staff_id' => $staffId, // IMPORTANT: This links the User to the Staff RBAC
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
