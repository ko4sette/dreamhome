<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Function and Trigger for Staff Supervisor Rules
        DB::unprepared('
            CREATE OR REPLACE FUNCTION enforce_supervisor_rules()
            RETURNS TRIGGER AS $$
            DECLARE
                supervisor_branch_id BIGINT;
                supervisor_position VARCHAR;
                staff_count INT;
            BEGIN
                IF NEW.supervisor_id IS NOT NULL THEN
                    -- Get the supervisor\'s details
                    SELECT branch_id, position INTO supervisor_branch_id, supervisor_position
                    FROM staff
                    WHERE staff_id = NEW.supervisor_id;
                    
                    -- Rule 1: Supervisor must be in the same branch
                    IF supervisor_branch_id != NEW.branch_id THEN
                        RAISE EXCEPTION \'Data Integrity Error: Staff and their supervisor must belong to the same branch. (Staff Branch ID: %, Supervisor Branch ID: %)\', NEW.branch_id, supervisor_branch_id;
                    END IF;
                    
                    -- Rule 2: Supervisor must actually have a supervisory position
                    IF supervisor_position NOT IN (\'Manager\', \'Supervisor\') THEN
                        RAISE EXCEPTION \'Data Integrity Error: A staff member can only be supervised by a Manager or Supervisor. Current supervisor position: %\', supervisor_position;
                    END IF;
                    
                    -- Rule 3: Case Study - Maximum 10 staff per supervisor
                    SELECT COUNT(*) INTO staff_count 
                    FROM staff 
                    WHERE supervisor_id = NEW.supervisor_id 
                      AND (NEW.staff_id IS NULL OR staff_id != NEW.staff_id);
                      
                    IF staff_count >= 10 THEN
                        RAISE EXCEPTION \'Case Study Rule: A Supervisor can manage a maximum of 10 staff members.\';
                    END IF;
                END IF;
                
                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;

            CREATE TRIGGER check_supervisor_rules_trigger
            BEFORE INSERT OR UPDATE ON staff
            FOR EACH ROW
            EXECUTE FUNCTION enforce_supervisor_rules();
        ');

        // 2. Function and Trigger for Property Assignment Rules
        DB::unprepared('
            CREATE OR REPLACE FUNCTION enforce_property_staff_branch()
            RETURNS TRIGGER AS $$
            DECLARE
                staff_branch_id BIGINT;
                property_count INT;
            BEGIN
                IF NEW.staff_id IS NOT NULL THEN
                    -- Get the staff\'s branch
                    SELECT branch_id INTO staff_branch_id
                    FROM staff
                    WHERE staff_id = NEW.staff_id;
                    
                    -- Check if branch matches
                    IF staff_branch_id != NEW.branch_id THEN
                        RAISE EXCEPTION \'Data Integrity Error: Property and assigned staff must belong to the same branch\';
                    END IF;
                    
                    -- Rule: Case Study - Maximum 20 properties per staff member
                    SELECT COUNT(*) INTO property_count 
                    FROM properties 
                    WHERE staff_id = NEW.staff_id 
                      AND (NEW.property_id IS NULL OR property_id != NEW.property_id);
                      
                    IF property_count >= 20 THEN
                        RAISE EXCEPTION \'Case Study Rule: A member of staff may only manage a maximum of 20 properties for rent at any one time.\';
                    END IF;
                END IF;
                
                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;

            CREATE TRIGGER check_property_branch_trigger
            BEFORE INSERT OR UPDATE ON properties
            FOR EACH ROW
            EXECUTE FUNCTION enforce_property_staff_branch();
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('
            DROP TRIGGER IF EXISTS check_property_branch_trigger ON properties;
            DROP FUNCTION IF EXISTS enforce_property_staff_branch();
            
            DROP TRIGGER IF EXISTS check_supervisor_rules_trigger ON staff;
            DROP FUNCTION IF EXISTS enforce_supervisor_rules();
        ');
    }
};
