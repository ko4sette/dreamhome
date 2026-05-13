<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Branch;
use App\Models\Owner;
use App\Models\Staff;
use App\Models\Property;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Users for Authentication
        User::updateOrCreate(
            ['email' => 'admin@dreamhome.test'],
            [
                'name' => 'Denver Galinato',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'staff@dreamhome.test'],
            [
                'name' => 'Staff User',
                'password' => Hash::make('password'),
                'role' => 'staff',
            ]
        );

        User::updateOrCreate(
            ['email' => 'client@dreamhome.test'],
            [
                'name' => 'Client User',
                'password' => Hash::make('password'),
                'role' => 'client',
            ]
        );

        // 2. Create Branch
        $branch = Branch::updateOrCreate(
            ['branch_name' => 'Glasgow Branch'],
            [
                'street' => '163 Main Street',
                'area' => 'Patrick',
                'city' => 'Glasgow',
                'postcode' => 'G11 9QX',
                'telephone' => '0141-339-2178',
                'fax_number' => '0141-339-2179',
            ]
        );

        // 3. Create Owners
        $owner1 = Owner::updateOrCreate(
            ['email' => 'sarah@example.com'],
            [
                'first_name' => 'Sarah',
                'last_name' => 'Brown',
                'phone' => '09171234567',
                'street' => '10 Rose Street',
                'city' => 'Glasgow',
            ]
        );

        $owner2 = Owner::updateOrCreate(
            ['email' => 'michael@example.com'],
            [
                'first_name' => 'Michael',
                'last_name' => 'Scott',
                'phone' => '09179876543',
                'street' => '10 Rose Street',
                'city' => 'Glasgow',
            ]
        );

        // 4. Create Staff
        $staff = Staff::updateOrCreate(
            ['nin' => 'AA123456B'],
            [
                'branch_id' => $branch->branch_id,
                'first_name' => 'Anne',
                'last_name' => 'Beech',
                'street' => '10 Rose Street',
                'city' => 'Glasgow',
                'phone' => '09170000000',
                'sex' => 'Female',
                'date_of_birth' => '1990-04-10',
                'position' => 'Supervisor',
                'salary' => 25000,
                'date_joined' => '2024-01-01',
            ]
        );

        // 5. Create Properties (Linked to above IDs)
        Property::updateOrCreate(
            ['street' => '6 Lawrence St.'],
            [
                'owner_id' => $owner1->owner_id,
                'branch_id' => $branch->branch_id,
                'staff_id' => $staff->staff_id,
                'property_type' => 'Flat',
                'area' => 'Patrick',
                'city' => 'Glasgow',
                'num_rooms' => 3,
                'monthly_rent' => 350.00,
                'status' => 'Available',
                'date_added' => now()->toDateString(),
                'is_active' => true,
            ]
        );

        Property::updateOrCreate(
            ['street' => '18 Dale Road'],
            [
                'owner_id' => $owner2->owner_id,
                'branch_id' => $branch->branch_id,
                'staff_id' => $staff->staff_id,
                'property_type' => 'House',
                'area' => 'Hyndland',
                'city' => 'Glasgow',
                'num_rooms' => 5,
                'monthly_rent' => 600.00,
                'status' => 'Available',
                'date_added' => now()->toDateString(),
                'is_active' => true,
            ]
        );
    }
}