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
        User::create([
            'name' => 'Denver Galinato',
            'email' => 'admin@dreamhome.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Staff User',
            'email' => 'staff@dreamhome.test',
            'password' => Hash::make('password'),
            'role' => 'staff',
        ]);

        User::create([
            'name' => 'Client User',
            'email' => 'client@dreamhome.test',
            'password' => Hash::make('password'),
            'role' => 'client',
        ]);

        // 2. Create Branch
        $branch = Branch::create([
            'branch_name' => 'Glasgow Branch',
            'street' => '163 Main Street',
            'area' => 'Patrick',
            'city' => 'Glasgow',
            'postcode' => 'G11 9QX',
            'telephone' => '0141-339-2178',
            'fax_number' => '0141-339-2179',
        ]);

        // 3. Create Owners
        $owner1 = Owner::create([
            'first_name' => 'Sarah',
            'last_name' => 'Brown',
            'phone' => '09171234567',
            'email' => 'sarah@example.com',
            'street' => '10 Rose Street',
            'city' => 'Glasgow',
        ]);

        $owner2 = Owner::create([
            'first_name' => 'Michael',
            'last_name' => 'Scott',
            'phone' => '09179876543',
            'email' => 'michael@example.com',
            'street' => '10 Rose Street',
            'city' => 'Glasgow',
        ]);

        // 4. Create Staff
        $staff = Staff::create([
            'branch_id' => $branch->branch_id,
            'first_name' => 'Anne',
            'last_name' => 'Beech',
            'street' => '10 Rose Street',
            'city' => 'Glasgow',
            'phone' => '09170000000',
            'sex' => 'Female',
            'date_of_birth' => '1990-04-10',
            'nin' => 'AA123456B',
            'position' => 'Supervisor',
            'salary' => 25000,
            'date_joined' => '2024-01-01',
        ]);

        // 5. Create Properties (Linked to above IDs)
        Property::create([
            'owner_id' => $owner1->owner_id,
            'branch_id' => $branch->branch_id,
            'staff_id' => $staff->staff_id,
            'property_type' => 'Flat',
            'street' => '6 Lawrence St.',
            'area' => 'Patrick',
            'city' => 'Glasgow',
            'num_rooms' => 3,
            'monthly_rent' => 350.00,
            'status' => 'Available',
            'date_added' => now()->toDateString(),
            'is_active' => true,
        ]);

        Property::create([
            'owner_id' => $owner2->owner_id,
            'branch_id' => $branch->branch_id,
            'staff_id' => $staff->staff_id,
            'property_type' => 'House',
            'street' => '18 Dale Road',
            'area' => 'Hyndland',
            'city' => 'Glasgow',
            'num_rooms' => 5,
            'monthly_rent' => 600.00,
            'status' => 'Available',
            'date_added' => now()->toDateString(),
            'is_active' => true,
        ]);
    }
}