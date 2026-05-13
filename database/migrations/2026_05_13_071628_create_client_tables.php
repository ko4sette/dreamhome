<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('client', function (Blueprint $table) {
            $table->id('client_id');
            $table->string('first_name', 50);
            $table->string('last_name', 50)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->char('gender', 1)->nullable();
            $table->string('email', 100)->unique()->nullable();
            $table->string('telephone', 15)->nullable();
            $table->string('address', 150)->nullable();
            $table->timestamp('date_created')->useCurrent();
            $table->timestamps();
        });

        Schema::create('client_preference', function (Blueprint $table) {
            $table->id('preference_id');
            $table->unsignedBigInteger('client_id');
            $table->string('preferred_property_type', 50)->nullable();
            $table->decimal('max_monthly_rent', 10, 2)->nullable();
            $table->text('comments')->nullable();
            $table->timestamps();

            $table->foreign('client_id')
                  ->references('client_id')->on('client')
                  ->onDelete('cascade');
        });

        Schema::create('client_registration', function (Blueprint $table) {
            $table->id('registration_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('branch_id');
            $table->date('registration_date')->nullable();
            $table->string('status', 20)->default('active');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('client_id')
                  ->references('client_id')->on('client')
                  ->onDelete('cascade');

            $table->foreign('branch_id')
                  ->references('branch_id')->on('branches')
                  ->onDelete('cascade');
        });

        Schema::create('client_assignment', function (Blueprint $table) {
            $table->id('assignment_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->date('assigned_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('client_id')
                  ->references('client_id')->on('client')
                  ->onDelete('cascade');

            $table->foreign('staff_id')
                  ->references('staff_id')->on('staff')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client_assignment');
        Schema::dropIfExists('client_registration');
        Schema::dropIfExists('client_preference');
        Schema::dropIfExists('client');
    }
};