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
        Schema::create('speaking_phrases', function (Blueprint $table) {
            $table->id();
            $table->text('phrase');
            $table->enum('skill_level', ['beginner', 'intermediate', 'advanced'])->default('beginner');
            $table->string('category')->nullable()->default('general');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('speaking_phrases');
    }
};