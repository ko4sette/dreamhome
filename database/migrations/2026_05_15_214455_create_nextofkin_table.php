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
        Schema::create('nextofkin', function (Blueprint $table) {
            $table->id('next_of_kin_id');
            $table->unsignedBigInteger('staff_id');
            $table->string('name');
            $table->string('relationship');
            $table->string('address');
            $table->string('telephone');
            $table->timestamps();

            $table->foreign('staff_id')
                ->references('staff_id')
                ->on('staff')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nextofkin');
    }
};
