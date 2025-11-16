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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');

            // --- ADDED FOR SPEC 2.A ---
            $table->enum('skill_level', ['beginner', 'intermediate', 'advanced'])->default('beginner');
            $table->string('category')->nullable(); // E.g., 'grammar', 'vocabulary', 'speaking'
            // --- END ADDED ---

            $table->string('image')->nullable();
            $table->string('video_url')->nullable();

            // --- ADDED FOR SPEC 2.B ---
            $table->string('audio_url')->nullable();
            // --- END ADDED ---

            $table->integer('price')->nullable();
            $table->string('duration')->nullable();
            $table->integer('enrollments')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Teacher/Creator
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};