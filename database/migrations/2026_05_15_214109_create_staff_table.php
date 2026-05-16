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
        Schema::create('staff', function (Blueprint $table) {
            $table->id('staff_id');
            $table->unsignedBigInteger('branch_id');
            $table->string('name', 50);
            $table->string('surname', 50);
            $table->unsignedBigInteger('supervisor_id')->nullable();
            $table->string('address', 150)->nullable();
            $table->string('telephone', 15)->nullable();
            $table->enum('gender', ['M', 'F'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('nin', 20)->unique()->nullable();
            $table->enum('position', [
                'Manager',
                'Secretary',
                'Supervisor',
                'Regular staff'
            ])->nullable();
            $table->decimal('salary', 10, 2)->nullable();
            $table->date('date_started')->nullable();
            $table->timestamps();

            $table->foreign('branch_id')
                ->references('branch_id')
                ->on('branches')
                ->onDelete('cascade');
        });

        Schema::table('staff', function (Blueprint $table) {
            $table->foreign('supervisor_id')
                ->references('staff_id')
                ->on('staff')
                ->onDelete('set null');
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
