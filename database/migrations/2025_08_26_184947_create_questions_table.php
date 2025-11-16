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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained()->onDelete('cascade');
            $table->text('title'); // The question text, e.g., "Fill in the blank: The cat __ on the mat."

            // --- ADDED FOR SPEC 3.A ---
            $table->enum('type', ['multiple_choice', 'fill_in_blank', 'matching'])->default('multiple_choice');
            // --- END ADDED ---

            // Made nullable for other question types
            $table->string('option_a')->nullable();
            $table->string('option_b')->nullable();
            $table->string('option_c')->nullable();
            $table->string('option_d')->nullable();

            // 'correct_answer' can hold 'a' for multiple_choice, or the exact string for 'fill_in_blank'
            $table->string('correct_answer')->nullable();

            // --- ADDED FOR SPEC 3.A (Matching) ---
            // Stores JSON for matching pairs, e.g., {"prompts": ["cat", "dog"], "answers": ["meow", "woof"]}
            $table->json('options')->nullable();
            // --- END ADDED ---

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};