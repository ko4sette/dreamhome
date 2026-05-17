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
        // 1. Create audit_logs table
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->string('user_role')->nullable();
            $table->string('operation_type');
            $table->string('table_name');
            $table->unsignedBigInteger('record_id')->nullable();
            $table->timestamps();
        });

        // 2. Function: Enforce Manager Role for Staff/NextOfKin operations
        DB::unprepared("
            CREATE OR REPLACE FUNCTION enforce_manager_only_staff_operations()
            RETURNS TRIGGER AS $$
            DECLARE
                current_user_role VARCHAR;
            BEGIN
                -- Attempt to get the session variable.
                BEGIN
                    current_user_role := current_setting('app.current_role', true);
                EXCEPTION WHEN OTHERS THEN
                    current_user_role := NULL;
                END;

                -- STRICT RULE: Only managers can manage staff records.
                IF current_user_role IS DISTINCT FROM 'manager' THEN
                    RAISE EXCEPTION 'Unauthorized action: Only managers can manage staff records.';
                END IF;

                IF TG_OP = 'DELETE' THEN
                    RETURN OLD;
                END IF;
                
                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;
        ");

        // 3. Attach Manager Role Triggers
        DB::unprepared("
            CREATE TRIGGER check_manager_role_staff_insert
            BEFORE INSERT ON staff
            FOR EACH ROW EXECUTE FUNCTION enforce_manager_only_staff_operations();

            CREATE TRIGGER check_manager_role_staff_update
            BEFORE UPDATE ON staff
            FOR EACH ROW EXECUTE FUNCTION enforce_manager_only_staff_operations();

            CREATE TRIGGER check_manager_role_staff_delete
            BEFORE DELETE ON staff
            FOR EACH ROW EXECUTE FUNCTION enforce_manager_only_staff_operations();
            
            -- NextOfKin triggers
            CREATE TRIGGER check_manager_role_nok_insert
            BEFORE INSERT ON nextofkin
            FOR EACH ROW EXECUTE FUNCTION enforce_manager_only_staff_operations();

            CREATE TRIGGER check_manager_role_nok_update
            BEFORE UPDATE ON nextofkin
            FOR EACH ROW EXECUTE FUNCTION enforce_manager_only_staff_operations();

            CREATE TRIGGER check_manager_role_nok_delete
            BEFORE DELETE ON nextofkin
            FOR EACH ROW EXECUTE FUNCTION enforce_manager_only_staff_operations();
        ");

        // 4. Function: Audit Logging
        DB::unprepared("
            CREATE OR REPLACE FUNCTION log_staff_audit()
            RETURNS TRIGGER AS $$
            DECLARE
                current_user_role VARCHAR;
            BEGIN
                BEGIN
                    current_user_role := current_setting('app.current_role', true);
                EXCEPTION WHEN OTHERS THEN
                    current_user_role := NULL;
                END;

                INSERT INTO audit_logs (user_role, operation_type, table_name, record_id, created_at, updated_at)
                VALUES (current_user_role, TG_OP, TG_TABLE_NAME, 
                        CASE WHEN TG_OP = 'DELETE' THEN OLD.staff_id ELSE NEW.staff_id END, 
                        NOW(), NOW());

                IF TG_OP = 'DELETE' THEN
                    RETURN OLD;
                END IF;
                
                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;
        ");

        // 5. Attach Audit Triggers to Staff
        DB::unprepared("
            CREATE TRIGGER audit_staff_insert
            AFTER INSERT ON staff
            FOR EACH ROW EXECUTE FUNCTION log_staff_audit();

            CREATE TRIGGER audit_staff_update
            AFTER UPDATE ON staff
            FOR EACH ROW EXECUTE FUNCTION log_staff_audit();

            CREATE TRIGGER audit_staff_delete
            AFTER DELETE ON staff
            FOR EACH ROW EXECUTE FUNCTION log_staff_audit();
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("
            DROP TRIGGER IF EXISTS audit_staff_insert ON staff;
            DROP TRIGGER IF EXISTS audit_staff_update ON staff;
            DROP TRIGGER IF EXISTS audit_staff_delete ON staff;
            DROP FUNCTION IF EXISTS log_staff_audit();

            DROP TRIGGER IF EXISTS check_manager_role_staff_insert ON staff;
            DROP TRIGGER IF EXISTS check_manager_role_staff_update ON staff;
            DROP TRIGGER IF EXISTS check_manager_role_staff_delete ON staff;
            
            DROP TRIGGER IF EXISTS check_manager_role_nok_insert ON nextofkin;
            DROP TRIGGER IF EXISTS check_manager_role_nok_update ON nextofkin;
            DROP TRIGGER IF EXISTS check_manager_role_nok_delete ON nextofkin;
            
            DROP FUNCTION IF EXISTS enforce_manager_only_staff_operations();
        ");

        Schema::dropIfExists('audit_logs');
    }
};
