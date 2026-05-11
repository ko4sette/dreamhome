<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('staff', function (Blueprint $table) {

            $table->id('staff_id');

            $table->foreignId('branch_id')
                  ->constrained('branches', 'branch_id')
                  ->onDelete('cascade');

            $table->string('first_name');
            $table->string('last_name');

            $table->string('street');
            $table->string('city');

            $table->string('phone');

            $table->enum('sex', ['Male', 'Female']);

            $table->date('date_of_birth');

            $table->string('nin')->unique();

            $table->enum('position', [
                'Manager',
                'Supervisor',
                'Secretary'
            ]);

            $table->decimal('salary', 10, 2);

            $table->date('date_joined');

            // Optional fields based on role
            $table->integer('typing_speed')->nullable();

            $table->date('manager_start_date')->nullable();

            $table->decimal('car_allowance', 10, 2)->nullable();

            $table->decimal('bonus', 10, 2)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};