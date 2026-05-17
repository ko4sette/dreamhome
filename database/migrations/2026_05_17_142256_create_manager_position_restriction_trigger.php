<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("
            CREATE OR REPLACE FUNCTION enforce_manager_creation_restriction()
            RETURNS TRIGGER AS $$
            DECLARE
                current_user_role VARCHAR;
            BEGIN
                -- Get the current session role
                BEGIN
                    current_user_role := current_setting('app.current_role', true);
                EXCEPTION WHEN OTHERS THEN
                    current_user_role := NULL;
                END;

                -- If the person performing the action is a manager
                IF current_user_role = 'manager' THEN
                    -- They cannot create or update a staff member to the position of 'Manager'
                    IF NEW.position = 'Manager' THEN
                        RAISE EXCEPTION 'Security Policy Violation: A Manager is not authorized to assign the Manager position to any staff member.';
                    END IF;
                END IF;

                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;
        ");

        DB::unprepared("
            CREATE TRIGGER check_manager_creation_restriction_insert
            BEFORE INSERT ON staff
            FOR EACH ROW EXECUTE FUNCTION enforce_manager_creation_restriction();

            CREATE TRIGGER check_manager_creation_restriction_update
            BEFORE UPDATE ON staff
            FOR EACH ROW EXECUTE FUNCTION enforce_manager_creation_restriction();
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("
            DROP TRIGGER IF EXISTS check_manager_creation_restriction_insert ON staff;
            DROP TRIGGER IF EXISTS check_manager_creation_restriction_update ON staff;
            DROP FUNCTION IF EXISTS enforce_manager_creation_restriction();
        ");
    }
};
