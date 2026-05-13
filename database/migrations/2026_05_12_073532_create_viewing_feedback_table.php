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
    Schema::create('viewing_feedback', function (Blueprint $table) {
        $table->increments('feedback_id');
        $table->unsignedInteger('viewing_id');
        $table->text('feedback_comment')->nullable();
        $table->integer('rating')->nullable();
        $table->boolean('interested')->default(false);
        $table->foreign('viewing_id')->references('viewing_id')->on('viewing')->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('viewing_feedback');
    }
};
