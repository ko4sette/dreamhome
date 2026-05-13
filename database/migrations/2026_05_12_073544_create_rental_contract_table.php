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
    Schema::create('rental_contract', function (Blueprint $table) {
        $table->increments('contract_id');
        $table->unsignedInteger('property_id');
        $table->unsignedBigInteger('client_id');
        $table->date('contract_start_date');
        $table->date('contract_end_date');
        $table->decimal('monthly_rent', 10, 2);
        $table->decimal('security_deposit', 10, 2)->nullable();
        $table->string('contract_status')->default('active');
        $table->text('terms_and_conditions')->nullable();
        $table->foreign('property_id')->references('property_id')->on('properties')->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_contract');
    }
};
