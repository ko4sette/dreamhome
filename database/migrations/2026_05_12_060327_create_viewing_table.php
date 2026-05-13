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
    Schema::create('viewing', function (Blueprint $table) {
        $table->increments('viewing_id');
        $table->unsignedInteger('property_id');
        $table->unsignedBigInteger('client_id'); // links to existing clients/owners
        $table->date('viewing_date')->nullable();
        $table->time('viewing_time')->nullable();
        $table->string('status')->default('scheduled');
        $table->foreign('property_id')->references('property_id')->on('properties')->onDelete('cascade');
        $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('viewing');
    }
};
