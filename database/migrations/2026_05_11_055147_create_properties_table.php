<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::create('properties', function (Blueprint $table) {
        $table->id('property_id');

        $table->foreignId('owner_id')
              ->constrained('owners', 'owner_id')
              ->onDelete('cascade');

        $table->foreignId('branch_id')
              ->constrained('branches', 'branch_id')
              ->onDelete('cascade');

        $table->foreignId('staff_id')
              ->constrained('staff', 'staff_id')
              ->onDelete('cascade');

        $table->string('property_name')->nullable(); // Made nullable since seeder doesn't always provide it
        $table->string('property_type');
        $table->string('street');
        
        // --- ADDED THESE TO MATCH YOUR SEEDER ---
        $table->string('area'); 
        $table->string('city');
        $table->string('postcode');
        $table->integer('num_rooms');
        // ----------------------------------------

        $table->decimal('monthly_rent', 10, 2);
        
        // --- ADDED THESE TO MATCH YOUR SEEDER ---
        $table->string('status')->default('Available');
        $table->date('date_added');
        $table->boolean('is_active')->default(true);
        // ----------------------------------------

        $table->text('description')->nullable();
        $table->string('image')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
